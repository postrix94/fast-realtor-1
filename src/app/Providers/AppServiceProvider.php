<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\SuperAdminPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user = null) {
            if(is_null($user)) return false;

            return $user->hasRole("super_admin");
        });


        Gate::policy(User::class,SuperAdminPolicy::class);
    }
}
