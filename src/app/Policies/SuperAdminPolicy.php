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

    public function assignRole(User $user = null) {

    }




}
