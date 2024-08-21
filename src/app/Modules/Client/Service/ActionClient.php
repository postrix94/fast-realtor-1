<?php

namespace App\Modules\Client\Service;

use App\Modules\Client\Client;
use App\Modules\Client\Repository\Interfaces\ReadClient;

class ActionClient
{
    private ReadClient $clientRepositoryRead;

    /**
     * ActionClient constructor.
     * @param ReadClient $clientRepositoryRead
     */
    public function __construct(ReadClient $clientRepositoryRead)
    {
        $this->clientRepositoryRead = $clientRepositoryRead;
    }

    /**
     * @return Client|null
     */
    public function auth(): Client|null
    {
        return $this->clientRepositoryRead->auth();
    }

    public function ads() {

    }
}
