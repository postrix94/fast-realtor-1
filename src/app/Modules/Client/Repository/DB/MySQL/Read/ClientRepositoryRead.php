<?php

namespace App\Modules\Client\Repository\DB\MySQL\Read;

use App\Models\User;
use App\Modules\Client\Client;
use App\Modules\Client\Repository\DB\MySQL\Traits\CreateClient;
use App\Modules\Client\Repository\Interfaces\ReadClient;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class ClientRepositoryRead implements ReadClient
{
    use CreateClient;

    private function newQuery(): Builder
    {
        return User::query();
    }

    public function auth(): Client|null
    {
        return Auth::check() ? $this->createClient(Auth::user()) : null;
    }
}
