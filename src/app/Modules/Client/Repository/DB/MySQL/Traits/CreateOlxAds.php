<?php


namespace App\Modules\Client\Repository\DB\MySQL\Traits;


use App\Modules\Client\Infrastructure\AdsCollection;
use App\Modules\OlxAdvertisement\OlxAdvertisement;
use Illuminate\Support\Collection;

trait CreateOlxAds
{
    /**
     * @param Collection $ads
     * @return AdsCollection
     */
    public function createOlxAds(Collection $ads): AdsCollection {

        $adsCollection = new AdsCollection;

        $ads->each(function ($ads) use ($adsCollection) {
            $adsOlx = new OlxAdvertisement(
                $ads->id,
                $ads->title,
                $ads->slug,
                $ads->body,
                $ads->price,
                $ads->owner_name,
                $ads->information,
                $ads->ad_id,
                $ads->commentary,
                $ads->olx,
                new Collection(),
                $ads->user_id,
                $ads->created_at,
            );

            $adsCollection->add($adsOlx);
        });


       return $adsCollection;
    }
}
