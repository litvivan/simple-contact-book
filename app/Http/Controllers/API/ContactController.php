<?php

namespace App\Http\Controllers\API;

use App\Repositories\Interfaces\ContactRepositoryInterface;

use App\Http\Requests\Contact\API\ShowRequest;
use App\Http\Requests\Contact\API\UpdateRequest;
use App\Http\Requests\Contact\API\StoreRequest;
use App\Http\Requests\Contact\API\DeleteRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected $contactRepository;

    /** @var \App\Models\Interfaces\IUser $currentUser */
    protected $currentUser = [];

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        // Use Auth middleware
        $this->middleware('auth:api');

        // Inject contact repository
        $this->contactRepository = $contactRepository;

        // Retrieve current user and share it with Views
        $this->middleware(function ($request, $next) {
            $this->currentUser = Auth::user();
            return $next($request);
        });

        // Disable debugbar on local environment (if installed)
        if (env('APP_ENV') === 'local' && class_exists('\Debugbar')) {
            \Debugbar::disable();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $contacts = $this->contactRepository->getAllByUserId($this->currentUser->getId());
        } catch (\Throwable $t) {
            return response($t->getMessage(), $t->getCode());
        }
        return response($contacts);
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request, int $id)
    {
        try {
            $contact = $this->contactRepository->getById($id);
        } catch (\Throwable $t) {
            return response($t->getMessage(), 500);
        }

        return response($contact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            /** @var \App\Models\Interfaces\IContact $contact */
            $contact = $this->contactRepository->createForUser($request->validated(), $this->currentUser->getId());
        } catch (\Throwable $t) {
            return response($t->getMessage(), 500);
        }

        return response($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, int $id)
    {
        $resp = null;

        $contact = $this->contactRepository->getById($id);
        try {
            $resp = $this->contactRepository->update($contact, $request->validated());
        } catch (\Throwable $t) {
            return response($t->getMessage(), $t->getCode());
        }
        return response($resp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, int $id)
    {
        $resp = null;

        try {
            $success = $this->contactRepository->delete($id);
            if ($success) {
                $resp = [
                    'status'    => 'success',
                    'id'        => $id
                ];
            }
        } catch (\Throwable $t) {
            return response($t->getMessage(), $t->getCode());
        }
        return response($resp);
    }
}
