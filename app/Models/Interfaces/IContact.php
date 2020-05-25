<?php

namespace App\Models\Interfaces;

interface IContact
{
    /* Getters */

    /**
     * Returns contact id
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Returns contact owner user id
     *
     * @return int
     */
    public function getOwnerId(): int;

    /**
     * Returns first name
     *
     * @return string
     */
    public function getFirstName(): string;

    /**
     * Returns last name
     *
     * @return string|null
     */
    public function getLastName(): ?string;

    /**
     * Returns patronymic name
     *
     * @return string|null
     */
    public function getPatronymicName(): ?string;

    /**
     * Returns phone number
     *
     * @return string
     */
    public function getPhone(): string;

    /**
     * Returns if contact is marked as favorite
     *
     * @return bool
     */
    public function getIsFavorite(): bool;

    /**
     * Returns full name
     *
     * @return string
     */
    public function getFullName(): string;

    /* Setters */

    /**
     * Sets contact id
     *
     * @param int $id
     *
     * @return IContact
     */
    public function setId(int $id): IContact;

    /**
     * Sets contact owner user id
     *
     * @param int $id
     *
     * @return IContact
     */
    public function setOwnerId(int $id): IContact;

    /**
     * Sets first name
     *
     * @param string $fname
     *
     * @return IContact
     */
    public function setFirstName(string $fname): IContact;

    /**
     * Sets last name
     *
     * @param string|null $lname
     *
     * @return IContact
     */
    public function setLastName(?string $lname): IContact;

    /**
     * Sets patronymic name
     *
     * @param string|null $pname
     *
     * @return IContact
     */
    public function setPatronymicName(?string $pname): IContact;

    /**
     * Sets phone number
     *
     * @param string $phone
     *
     * @return IContact
     */
    public function setPhone(string $phone): IContact;

    /**
     * Sets flag if contact is marked as favorite
     *
     * @param bool $isFavorite
     *
     * @return IContact
     */
    public function setIsFavorite(bool $isFavorite): IContact;

    /**
     * Set contact data from attributes array
     *
     * @param  $contact
     * @param  array $data
     * @return IContact 
     */
    public function setData(array $data): IContact;
}
