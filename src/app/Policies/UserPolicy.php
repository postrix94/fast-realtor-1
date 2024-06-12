<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool|null
     */
    public function before(User $user) {
        if(is_null($user)) return  false;

        if($user->hasRole("super_admin")) {
            return true;
        }

        return null;
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function publicLink(User $user = null) {

        if(is_null($user)) return  false;

        return ($user->hasRole(["user","vip_user", "admin"]) && $user->hasPermissionTo("public link"));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function saveImages(User $user = null) {
        if(is_null($user)) return  false;

        return ($user->hasRole(["vip_user", "admin"]) && $user->hasPermissionTo("save images"));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function sendToTelegram(User $user = null) {
        if(is_null($user)) return  false;

        return ($user->hasRole(["vip_user", "admin"]) && $user->hasPermissionTo("send to telegram"));
    }


    /**
     * @param User|null $user
     * @return bool
     */
    public function viewUser(User $user = null) {
        if(is_null($user)) return  false;

        return ($user->hasRole(["admin"]) && $user->hasPermissionTo("view user"));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function addNewUser(User $user = null) {
        if(is_null($user)) return  false;


        return ($user->hasRole(["admin"]) && $user->hasPermissionTo("add new user"));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function blockedUser(User $user = null) {
        if(is_null($user)) return  false;

        return ($user->hasRole(["admin"]) && $user->hasPermissionTo("blocked user"));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function viewUserPayment(User $user = null) {
        if(is_null($user)) return  false;

        return ($user->hasRole(["admin"]) && $user->hasPermissionTo("view user payment"));
    }


    /**
     * @param User|null $user
     * @return bool
     */
    public function roleManagement(User $user = null) {
        if (is_null($user)) return false;

        return ($this->assignRole($user) && $this->changeRole($user) && $this->removeRole($user));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function assignRole(User $user = null)
    {
        if (is_null($user)) return false;

        return ($user->hasRole(["super_admin"]) && $user->hasPermissionTo("assign role"));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function changeRole(User $user = null)
    {
        if (is_null($user)) return false;

        return ($user->hasRole(["super_admin"]) && $user->hasPermissionTo("change role"));
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function removeRole(User $user = null)
    {
        if (is_null($user)) return false;

        return ($user->hasRole(["super_admin"]) && $user->hasPermissionTo("remove role"));
    }
}
