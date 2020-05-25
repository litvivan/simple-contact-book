<?php

namespace App\Models\Interfaces;

interface IUser
{
    /* Getters */

    /**
     * Returns user id
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Returns user name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Returns user email
     *
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * Returns user Api Token
     *
     * @return string|null
     */
    public function getApiToken(): ?string;

    /* Setters */

    /**
     * Sets user id
     *
     * @param int $id
     * @return IUser
     */
    public function setId(int $id): IUser;

    /**
     * Sets user name
     *
     * @param string $name
     * @return IUser
     */
    public function setName(string $name): IUser;

    /**
     * Sets user email
     *
     * @param string $email
     * @return IUser
     */
    public function setEmail(string $email): IUser;

    /**
     * Sets user Api Token
     *
     * @param string $apiToken
     * @return IUser
     */
    public function setApiToken(?string $apiToken): IUser;
}
