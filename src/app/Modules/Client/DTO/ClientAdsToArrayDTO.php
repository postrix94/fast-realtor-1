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
                "price" => $ads->getPrice(),
                "olx" => $ads->getOlx(),
                "created" => $ads->getCreatedAt(),
                "public_url_ads" => route("olx.ads.show", ["slug" => $ads->getSlug()]),
                "edit_url_ads" => route("olx.ads.edit", ["slug" => $ads->getSlug()]),
                "delete_url_ads" => route("olx.ads.delete", ["slug" => $ads->getSlug()]),
            ];
        }

        return $list;
    }
}
