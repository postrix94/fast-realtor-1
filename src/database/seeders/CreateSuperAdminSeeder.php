<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name" => Config::get("super_admin.name"),
            'phone' => Config::get("super_admin.phone"),
            'is_blocked' => false,
            'password' => Hash::make(Config::get("super_admin.password")),
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp,
        ]);

        $permissions = Permission::all();
        $roles = Role::all();

//        Config::set("auth.defaults.guard", "admin");

        $user->assignRole($roles);
    }
}
