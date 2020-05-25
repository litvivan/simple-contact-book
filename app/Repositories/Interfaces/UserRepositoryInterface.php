<?php

namespace App\Repositories\Interfaces;

use App\Models\Interfaces\IUser;
use Illuminate\Support\Collection;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface
{
    /**
     * Returns collection of all users
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Returns User entity by id
     *
     * @param $id
     *
     * @return IUser
     */
    public function getById($id): IUser;
}
