<?php


namespace App\Modules\Client\Repository\Interfaces;

use App\Modules\Client\Client;

interface ReadClient
{
    /**
     * @return Client|null
     */
    public function auth(): Client|null;
}
