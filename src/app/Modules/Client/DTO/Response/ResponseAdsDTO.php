<?php


namespace App\Modules\Client\DTO\Response;


use App\Modules\Client\Infrastructure\AdsCollection;

class ResponseAdsDTO
{
    public int $totalRecords;
    public AdsCollection $ads;

    /**
     * ResponseAdsDTO constructor.
     * @param int $totalRecords
     * @param AdsCollection $ads
     */
    public function __construct(AdsCollection $ads, int $totalRecords)
    {
        $this->totalRecords = $totalRecords;
        $this->ads = $ads;
    }
}
