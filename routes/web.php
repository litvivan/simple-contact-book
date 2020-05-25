<?php

use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/* Main page - contact list */
Route::get('/', [ContactController::class, 'index'])->name('contact.list');

/* Contact routes */
Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contact.view');
Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::get('/add-contact', [ContactController::class, 'create'])->name('contact.create');

Route::post('/add-contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/contacts/{id}', [ContactController::class, 'update'])->name('contact.update');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contact.delete');
