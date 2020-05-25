<?php

namespace App\Models;

use App\Models\Interfaces\IUser;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements IUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns user id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return (int) $this->id;
    }

    /**
     * Returns user name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return (string) $this->name;
    }

    /**
     * Returns user email
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return (string) $this->email;
    }

    /**
     * Returns user Api Token
     * @return string|null
     */
    function getApiToken(): ?string
    {
        return $this->api_token;
    }

    /**
     * Sets user id
     *
     * @param int $id
     * @return IUser
     */
    public function setId(int $id): IUser
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Sets user name
     *
     * @param string $name
     * @return IUser
     */
    public function setName(string $name): IUser
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Sets user email
     *
     * @param string $email
     * @return IUser
     */
    public function setEmail(string $email): IUser
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Sets user Api Token
     *
     * @param string|null $apiToken
     * @return IUser
     */
    public function setApiToken(?string $apiToken): IUser
    {
        $this->api_token = $apiToken;
        return $this;
    }
}
