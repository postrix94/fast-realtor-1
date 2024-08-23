<?php

namespace App\Modules\Client\Service;

use App\Modules\Client\Client;
use App\Modules\Client\DTO\AdsPaginationDTO;
use App\Modules\Client\DTO\AdsSearchDTO;
use App\Modules\Client\DTO\ClientAdsToArrayDTO;
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


    /**
     * @param AdsPaginationDTO $paginationDTO
     * @param AdsSearchDTO $search
     * @return array
     */
    public function ads(AdsPaginationDTO $paginationDTO, AdsSearchDTO $search): array
    {
        $result = $this->clientRepositoryRead->ads($paginationDTO, $search);

        return [
            "ads" => ClientAdsToArrayDTO::handle($result),
            "totalRecords" => $result->totalRecords,
        ];
    }
}
