<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Config::get("permission.roles_to_permissions") as $role => $permissions) {
           $newRole = Role::create(['name' => $role]);

           foreach ($permissions as $permission) {
               Permission::create(['name' => $permission]);
               $newRole->givePermissionTo($permission);
           }
        }
    }
}
