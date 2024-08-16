<?php


namespace App\Modules\Client;


use Illuminate\Support\Collection;

class Client
{
    private int $id;
    private string $name;
    private string $phone;
    private bool $isBlocked;
    private bool $isAuth;
    private Collection $roles;
    private Collection $permissions;


    /**
     * Client constructor.
     * @param int $id
     * @param string $name
     * @param string $phone
     * @param bool $isBlocked
     * @param Collection $roles
     * @param Collection $permissions
     * @param bool $isAuth
     */
    public function __construct(int $id, string $name, string $phone, bool $isBlocked, Collection $roles, Collection $permissions, bool $isAuth)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->isBlocked = $isBlocked;
        $this->roles = $roles;
        $this->permissions = $permissions;
        $this->isAuth = $isAuth;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->isBlocked;
    }

    /**
     * @param bool $isBlocked
     */
    public function setIsBlocked(bool $isBlocked): void
    {
        $this->isBlocked = $isBlocked;
    }

    /**
     * @return bool
     */
    public function isAuth(): bool
    {
        return $this->isAuth;
    }


}
