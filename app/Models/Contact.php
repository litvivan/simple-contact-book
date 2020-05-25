<?php

namespace App\Models;

use App\Models\Interfaces\IContact;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model implements IContact
{
    
    protected $fillable = [
        'owner_id', 'first_name', 'last_name', 'patronymic_name', 'is_favorite'
    ];

    /**
     * Returns contact id
     *
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * Returns contact owner user id
     *
     * @return int
     */
    public function getOwnerId(): int
    {
        return (int) $this->owner_id;
    }

    /**
     * Returns first name
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * Returns last name
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * Returns patronymic name
     *
     * @return string|null
     */
    public function getPatronymicName(): ?string
    {
        return $this->patronymic_name;
    }

    /**
     * Returns phone number
     *
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Returns if contact is marked as favorite
     *
     * @return bool
     */
    public function getIsFavorite(): bool
    {
        return (bool) $this->is_favorite;
    }

    /**
     * Returns full name
     *
     * @return string
     */
    public function getFullName(): string
    {
        $fullName = $this->getLastName() . ' ' . $this->getFirstName() . ' ' . $this->getPatronymicName();
        return $fullName;
    }

    /**
     * Sets contact id
     *
     * @param int $id
     *
     * @return IContact
     */
    public function setId(int $id): IContact
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Sets contact owner user id
     *
     * @param int $id
     *
     * @return IContact
     */
    public function setOwnerId(int $id): IContact
    {
        $this->owner_id = $id;
        return $this;
    }

    /**
     * Sets first name
     *
     * @param string $fname
     *
     * @return IContact
     */
    public function setFirstName(string $fname): IContact
    {
        $this->first_name = $fname;
        return $this;
    }

    /**
     * Sets last name
     *
     * @param string|null $lname
     *
     * @return IContact
     */
    public function setLastName(?string $lname): IContact
    {
        $this->last_name = $lname;
        return $this;
    }

    /**
     * Sets patronymic name
     *
     * @param string|null $pname
     *
     * @return IContact
     */
    public function setPatronymicName(?string $pname): IContact
    {
        $this->patronymic_name = $pname;
        return $this;
    }

    /**
     * Sets phone number
     *
     * @param string $phone
     *
     * @return IContact
     */
    public function setPhone(string $phone): IContact
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Sets flag if contact is marked as favorite
     *
     * @param bool $isFavorite
     *
     * @return IContact
     */
    public function setIsFavorite(bool $isFavorite): IContact
    {
        $this->is_favorite = $isFavorite;
        return $this;
    }

    /**
     * Set contact data from attributes array
     *
     * @param  $contact
     * @param  array $data
     * @return IContact 
     */
    public function setData(array $data): IContact
    {
        if (isset($data['owner_id'])) {
            $this->setOwnerId($data['owner_id']);
        }

        if (isset($data['first_name'])) {
            $this->setFirstName($data['first_name']);
        }

        if (isset($data['last_name'])) {
            $this->setLastName($data['last_name']);
        }

        if (isset($data['patronymic_name'])) {
            $this->setPatronymicName($data['patronymic_name']);
        }

        if (isset($data['phone'])) {
            $this->setPhone($data['phone']);
        }

        if (isset($data['is_favorite'])) {
            $this->setIsFavorite($data['is_favorite']);
        }

        return $this;
    }
}
