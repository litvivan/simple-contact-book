<?php

use App\Http\Controllers\API\ContactController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('contacts')->middleware(['auth:api', 'json.response'])->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('api.contact.list');
    Route::get('/{id}', [ContactController::class, 'show'])->name('api.contact.get');
    Route::post('/', [ContactController::class, 'store'])->name('api.contact.create');
    Route::put('/{id}', [ContactController::class, 'update'])->name('api.contact.update');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('api.contact.delete');
});

