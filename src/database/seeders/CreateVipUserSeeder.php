<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class CreateVipUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name" => "Vip User",
            'phone' => "0631234567",
            'is_blocked' => false,
            'password' => "12345",
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp,
        ]);

        foreach (Config::get("permission.roles_to_permissions") as $role => $permissions) {
            foreach (Config::get("permission.guard_by_roles") as $guard => $roles) {
                if(in_array($role, Config::get("permission.guard_by_roles")[$guard])) {
                    Config::set("auth.defaults.guard", $guard);
                    $user->assignRole($role);
                }
            }

            if($role === "vip_user") return;
        }
    }
}
