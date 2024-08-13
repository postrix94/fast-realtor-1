<?php

namespace App\Providers;

use App\Models\User;
use App\Modules\Client\Repository\DB\MySQL\Read\ClientRepositoryRead;
use App\Modules\Client\Repository\Interfaces\ReadClient;
use App\Policies\UserPolicy;
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
        Gate::policy(User::class, UserPolicy::class);
        $this->app->bind(ReadClient::class, ClientRepositoryRead::class);
    }
}
