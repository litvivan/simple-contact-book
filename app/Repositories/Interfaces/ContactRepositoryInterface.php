<?php

namespace App\Repositories\Interfaces;

use App\Models\Interfaces\IContact;
use App\Models\Interfaces\IUser;

use Illuminate\Support\Collection;

/**
 * Interface ContactRepositoryInterface
 * @package App\Repositories\Interfaces
 *
 * @todo with the project growth: possibly separate READ and WRITE operation sections
 */
interface ContactRepositoryInterface
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
    public function all();

    /**
     * Returns collection of contacts for specific user id
     *
     * @param int $userId
     * @param bool $sortByFullName
     *
     * @return Collection
     */
    public function getAllByUserId(int $userId, bool $sortByFullName = false): Collection;

    /**
     * Returns contact by id
     *
     * @param int $id
     *
     * @return IContact
     *
     * @throws \Exception
     */
    public function getById(int $id): IContact;

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
    public function create(array $contactData): IContact;

    /**
     * Creates new contact entity for user with specified id
     *
     * @param array $contactData
     * @param int $userId
     *
     * @return IContact
     */
    public function createForUser(array $contactData, int $userId): IContact;

    /**
     * Update existing contact entity
     *
     * @param IContact $contact
     * @param array $contactData
     *
     * @return IContact
     */
    public function update(IContact $contact, array $contactData): IContact;

    /**
     * Delete contact entity
     *
     * @param  int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
