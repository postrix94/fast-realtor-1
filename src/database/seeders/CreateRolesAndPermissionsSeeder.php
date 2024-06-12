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

           if(in_array($role, Config::get("permission.guard_by_roles.web"))) {
               $newRole = Role::create(['name' => $role, 'guard_name' => "web"]);
               foreach ($permissions as $permission) {

                   if(in_array($permission, Config::get("permission.guard_by_permissions.web"))) {
                       Permission::create(['name' => $permission, 'guard_name' => 'web']);
                       $newRole->givePermissionTo($permission);
                   }

//               if(in_array($permission, Config::get("permission.guard_by_permissions.admin"))){
//                   Permission::create(['name' => $permission, 'guard_name' => 'admin']);
//                   $newRole->givePermissionTo($permission);
//               }
//
//
               }
           }

//           if(in_array($role, Config::get("permission.guard_by_roles.admin"))){
               $newRole = Role::create(['name' => $role, 'guard_name' => "admin"]);
            foreach ($permissions as $permission) {

//                if(in_array($permission, Config::get("permission.guard_by_permissions.web"))) {
//                    Permission::create(['name' => $permission, 'guard_name' => 'web']);
//                    $newRole->givePermissionTo($permission);
//                }

//               if(in_array($permission, Config::get("permission.guard_by_permissions.admin"))){
                Permission::create(['name' => $permission, 'guard_name' => 'admin']);
                $newRole->givePermissionTo($permission);
//               }
//
//
            }
//           }


        }
    }
}
