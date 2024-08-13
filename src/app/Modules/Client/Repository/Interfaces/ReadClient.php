<?php


namespace App\Modules\Client\Repository\Interfaces;

use App\Modules\Client\Client;

interface ReadClient
{
    public function auth(): Client|null;
}
