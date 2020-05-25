<?php

namespace App\Http\Requests\Contact;

use App\Models\Interfaces\IContact;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteRequest extends FormRequest
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        parent::__construct();
        $this->contactRepository = $contactRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $contactId = (int) $this->route()->parameter('id');

        $contact = $this->contactRepository->getById($contactId);
        $contactOwnerId = $contact->getOwnerId();

        /** @var \App\Models\Interfaces\IUser $currentUser */
        $currentUser = Auth::user();

        return ($contactOwnerId === $currentUser->getId());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}
