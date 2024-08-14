<?php


namespace App\Modules\Client\Infrastructure;


class Role
{
    private string $name;
    private string $guard_name;


    /**
     * Role constructor.
     * @param string $name
     * @param string $guard_name
     */
    public function __construct(string $name, string $guard_name)
    {
        $this->name = $name;
        $this->guard_name = $guard_name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getGuardName(): string
    {
        return $this->guard_name;
    }

    /**
     * @param string $guard_name
     */
    public function setGuardName(string $guard_name): void
    {
        $this->guard_name = $guard_name;
    }


}