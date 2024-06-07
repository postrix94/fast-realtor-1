<?php

namespace App\Policies;

use App\Models\User;

class SuperAdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

//    public function before(User $user = null): bool|null
//    {
//        dd("4545");
//        if (is_null($user)) return false;
//
//        if ($user->hasRole("super_admin")) {
//            dd("4545");
//            return true;
//        }
//
//
//        return null;
//    }

    public function assignRole(User $user = null)
    {
        dd('ds');
    }


}
