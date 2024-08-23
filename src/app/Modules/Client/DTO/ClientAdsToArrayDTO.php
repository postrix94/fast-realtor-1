<?php


namespace App\Modules\Client\DTO;


use App\Modules\Client\DTO\Response\ResponseAdsDTO;


class ClientAdsToArrayDTO
{
    /**
     * @param ResponseAdsDTO $clientAds
     * @return array
     */
    public static function handle(ResponseAdsDTO $clientAds): array
    {
        $list = [];

        foreach ($clientAds->ads->get() as $ads) {
            $list[] = [
                "id" => $ads->getId(),
                "title" => $ads->getTitle(),
                "slug" => $ads->getSlug(),
                "price" => $ads->getPrice(),
                "olx" => $ads->getOlx(),
                "created" => $ads->getCreatedAt(),
            ];
        }

        return $list;
    }
}
