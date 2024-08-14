<?php


namespace App\Modules\Client\Repository\DB\MySQL\Traits;


use App\Models\User;
use App\Modules\Client\Client;
use App\Modules\Client\Infrastructure\Permission;
use App\Modules\Client\Infrastructure\Role;

trait CreateClient
{
    private function createClient(User $user): Client
    {
        $roles = $user->roles->map(fn($role) => $this->createRole($role));
        $permissions = $user->getPermissionsViaRoles()->map(fn($permission) => $this->createPermission($permission));

        return new Client($user->id, $user->name, $user->phone, $user->is_blocked, $roles, $permissions);
    }

    /**
     * @param \Spatie\Permission\Models\Role $role
     * @return Role
     */
    private function createRole(\Spatie\Permission\Models\Role $role): Role
    {
        return new Role($role->name, $role->guard_name);
    }

    /**
     * @param \Spatie\Permission\Models\Permission $permission
     * @return Permission
     */
    private function createPermission(\Spatie\Permission\Models\Permission $permission): Permission {
        return new Permission($permission->name, $permission->guard_name);
    }
}