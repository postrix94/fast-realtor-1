<?php


namespace App\Modules\OlxAdvertisement\DTO;


use App\Modules\Client\DTO\ClientToArrayDTO;
use App\Modules\OlxAdvertisement\OlxAdvertisement;

final class OlxAdvertisementToArrayDTO
{
    public static function toArray(OlxAdvertisement $ads): array
    {
        $client =ClientToArrayDTO::toArray($ads->client());
        $images =$ads->getImages()->map(function ($image) {
            return [
                "id" => $image->getId(),
                "link" => $image->getLink(),
                "add_id" => $image->getAddId(),
            ];
        })->toArray();


        return [
            "id" => $ads->getId(),
            "title" => $ads->getTitle(),
            "slug" => $ads->getSlug(),
            "body" => $ads->getBody(),
            "price" => $ads->getPrice(),
            "owner_name" => $ads->getOwnerName(),
            "information" => $ads->getInformation(),
            "ads_id" => $ads->getAdId(),
            "olx" => $ads->getOlx(),
            "commentary" => $ads->getCommentary(),
            "user_id" => $ads->getUserId(),
            "created_at" => $ads->getCreatedAt(),
            "images" => $images,
            "user" => $client,
            "is_owner" => $ads->is_owner,
        ];
    }
}
