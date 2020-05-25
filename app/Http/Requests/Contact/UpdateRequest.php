<?php

namespace App\Http\Requests\Contact;

use App\Repositories\Interfaces\ContactRepositoryInterface;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UpdateRequest extends FormRequest
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
        $contactId = (int) $this->post()['id'];

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
            'first_name'        => 'required',
            'last_name'         => 'string|nullable',
            'patronymic_name'   => 'string|nullable',
            'phone'             => 'required',
            'is_favorite'       => 'boolean|nullable',
        ];
    }
}
