<?php


namespace App\Modules\OlxAdvertisement\Repository\DB\MySql\Traits;

use App\Models\OlxAdvertisement as OlxAdvertisementModel;
use App\Modules\Client\Repository\DB\MySQL\Traits\CreateClient;
use App\Modules\OlxAdvertisement\Infrastructure\Image;
use App\Modules\OlxAdvertisement\OlxAdvertisement;

trait CreateOlxAdvertisement
{
    use CreateClient;
    /**
     * @param OlxAdvertisementModel $ads
     * @return OlxAdvertisement
     */
    private function createOlxAdvertisement(OlxAdvertisementModel $ads): OlxAdvertisement
    {
        $imagesCollection = $ads->images->map(function ($image) {
            return new Image($image->link, $image->id, $image->add_id);
        });

        $client = $this->createClient($ads->user);

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
            $imagesCollection,
            $ads->user_id,
            $ads->created_at,
            $client,
        );

        return $adsOlx;
    }


}
