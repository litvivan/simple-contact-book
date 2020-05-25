<?php

namespace App\Repositories;

// Interfaces
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Models\Interfaces\IContact;

// Models
use App\Models\Contact;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class EloquentContactRepository
 * Implements ContactRepositoryInterface for Eloquent Contact model
 *
 * @todo with the project growth: possibly separate READ and WRITE operation sections
 */
class EloquentContactRepository implements ContactRepositoryInterface
{
    /* ===============
     * READ SECTION
     * ===============
     */

    /**
     * Returns collection of all contacts
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Contact::all();
    }

    /**
     * Returns collection of contacts for specific user id
     *
     * @param int $userId
     * @param bool $sortByFullName
     *
     * @return Collection
     */
    public function getAllByUserId(int $userId, bool $sortByFullName = false): Collection
    {
        /** @var \Illuminate\Database\Eloquent\Model $contactCollection */
        $contactCollection = Contact::where('owner_id', $userId);

        // Sorting by Full Name (ASC) - if needed
        if ($sortByFullName) {
            $contactCollection->select()->addSelect(DB::raw('CONCAT_WS(" ", last_name, first_name, patronymic_name) AS full_name'));
            $contactCollection->orderBy('full_name', 'asc');
        }

        return $contactCollection->get();
    }

    /**
     * Returns contact by id
     *
     * @param int $id
     *
     * @return IContact
     *
     * @throws \Exception
     */
    public function getById(int $id): IContact
    {
        return Contact::where('id', $id)->firstOrFail();
    }

    /* ===============
     * WRITE SECTION
     * ===============
     */

    /**
     * Creates new contact entity
     *
     * @param array $contactData
     *
     * @return IContact
     */
    public function create(array $contactData): IContact
    {
        /** @var Contact $contact */
        $contact = new Contact();
        $contact->setData($contactData);
        $contact->save();

        return $contact;
    }

    /**
     * Creates new contact entity for user with specified id
     *
     * @param array $contactData
     * @param int $userId
     *
     * @return IContact
     */
    public function createForUser(array $contactData, int $userId): IContact
    {
        $contactData['owner_id'] = $userId;
        return $this->create($contactData);
    }

    /**
     * Update existing contact entity
     *
     * @param IContact $contact
     * @param array $contactData
     *
     * @return IContact
     */
    public function update(IContact $contact, array $contactData): IContact
    {
        /** @var Contact $contact */
        $contact->setData($contactData);
        $contact->save();

        return $contact;
    }

    /**
     * Delete contact entity
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Contact::destroy($id);
    }
}
