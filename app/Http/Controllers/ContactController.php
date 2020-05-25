<?php

namespace App\Http\Controllers;

// Interfaces
use App\Repositories\Interfaces\ContactRepositoryInterface;

// Classes
use App\Http\Requests\Contact\ShowRequest;
use App\Http\Requests\Contact\StoreRequest;
use App\Http\Requests\Contact\UpdateRequest;
use App\Http\Requests\Contact\DeleteRequest;

use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Contact repository
    protected $contactRepository;

    // Current user
    /** @var \App\Models\Interfaces\IUser $currentUser */
    protected $currentUser;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        // Use Auth middleware
        $this->middleware('auth');

        // Retrieve current user and share it with Views
        $this->middleware(function ($request, $next) {
            $this->currentUser = Auth::user();
            view()->share('currentUser', $this->currentUser);
            return $next($request);
        });

        // Inject contactRepository
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display contacts list for current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userContacts = $this->contactRepository->getAllByUserId($this->currentUser->getId(), true);

        return view('contacts.list', ['contacts' => $userContacts]);
    }

    /**
     * Display contact info.
     *
     * @param ShowRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request, int $id)
    {
        $contact = $this->contactRepository->getById($id);
        return view('contacts.view', ['contact' => $contact]);
    }

    /**
     * Display contact create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Display contact edit form.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        /** @var \App\Models\Interfaces\IContact $contact */
        $contact = $this->contactRepository->getById($id);

        return view('contacts.edit', ['contact' => $contact]);
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
            $messages[] = [
                'type'      => 'success',
                'text'      => __('Contact successfully created') . '!'
            ];
        } catch (\Throwable $t) {
            $messages[] = [
                'type'      => 'error',
                'text'      => $t->getMessage()
            ];
        }

        return redirect()->route('contact.view', $contact->getId())->with(['messages' => $messages]);
    }

    /**
     * Update contact in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, int $id)
    {
        // Response success/error message
        $messages = [];

        /** @var \App\Models\Interfaces\IContact $contact */
        $contact = $this->contactRepository->getById($id);

        try {
            // Saving contact validated data
            $this->contactRepository->update($contact, $request->validated());
            $messages[] = [
                'type'      => 'success',
                'text'      => __('Contact successfully saved') . '!'
            ];
        } catch (\Throwable $t) {
            $messages[] = [
                'type'      => 'error',
                'text'      => $t->getMessage()
            ];
        }


        return redirect()->route('contact.view', $contact)->with(['messages' => $messages]);
    }

    /**
     * Remove contact from storage.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, int $id)
    {
        // Response success/error message
        $messages = [];

        try {
            // Saving contact validated data
            $this->contactRepository->delete($id);
            $messages[] = [
                'type'      => 'success',
                'text'      => __('Contact successfully deleted') . '.'
            ];
        } catch (\Throwable $t) {
            $messages[] = [
                'type'      => 'error',
                'text'      => $t->getMessage()
            ];
        }


        return redirect()->route('contact.list')->with(['messages' => $messages]);
    }
}
