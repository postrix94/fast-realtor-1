<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesAndPermissionsSeeder extends Seeder
{

    protected Role $newRole;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Config::get("permission.roles_to_permissions") as $role => $permissions) {

            if (in_array($role, Config::get("permission.guard_by_roles.web"))) {
                $newRoleGuardWeb = Role::create(['name' => $role, 'guard_name' => "web"]);
                $this->guardByPermissions($permissions,$newRoleGuardWeb);
            }

            if (in_array($role, Config::get("permission.guard_by_roles.admin"))) {
                $newRoleGuardAdmin = Role::create(['name' => $role, 'guard_name' => "admin"]);
                $this->guardByPermissions($permissions, $newRoleGuardAdmin, "admin");
            }
        }
    }


    protected function guardByPermissions(array $permissions, Role $role, string $guard = "web"): void {
        foreach ($permissions as $permission) {
                Permission::create(['name' => $permission, 'guard_name' => $guard]);
                $role->givePermissionTo($permission);
        }
    }

}
