<?php


namespace App\Modules\Client\Repository\Interfaces;

use App\Modules\Client\Client;
use App\Modules\Client\DTO\AdsPaginationDTO;
use App\Modules\Client\DTO\AdsSearchDTO;
use App\Modules\Client\DTO\Response\ResponseAdsDTO;

interface ReadClient
{
    /**
     * @return Client|null
     */
    public function auth(): Client|null;


    /**
     * @param AdsPaginationDTO $paginationDTO
     * @param AdsSearchDTO $search
     * @return ResponseAdsDTO
     */
    public function ads(AdsPaginationDTO $paginationDTO, AdsSearchDTO $search): ResponseAdsDTO;
}
