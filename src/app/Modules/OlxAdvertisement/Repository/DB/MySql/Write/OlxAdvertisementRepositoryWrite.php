<?php

namespace App\Modules\OlxAdvertisement\Repository\DB\MySql\Write;

use App\Models\OlxAdvertisement as OlxAdvertisementModel;
use App\Modules\OlxAdvertisement\OlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\Interfaces\WriteOlxAdvertisement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OlxAdvertisementRepositoryWrite implements WriteOlxAdvertisement
{
    /**
     * @return Builder
     */
    private function newQuery(): Builder
    {
        return OlxAdvertisementModel::query();
    }

    /**
     * @param OlxAdvertisement $olxAdvertisement
     * @return OlxAdvertisement|false
     * @throws \Throwable
     */
    public function create(OlxAdvertisement $olxAdvertisement): false|OlxAdvertisement
    {
        try {
            DB::beginTransaction();

            $ads = $this->newQuery()->create(
                [
                    "title" => $olxAdvertisement->getTitle(),
                    "slug" => $olxAdvertisement->getSlug(),
                    "body" => $olxAdvertisement->getBody(),
                    "price" => $olxAdvertisement->getPrice(),
                    "owner_name" => $olxAdvertisement->getOwnerName(),
                    "information" => $olxAdvertisement->getInformation(),
                    "ad_id" => $olxAdvertisement->getAdId(),
                    "olx" => $olxAdvertisement->getOlx(),
                    "user_id" => Auth::id(),
                ]
            );

            $images = $olxAdvertisement->getImages()
                ->map(function ($img) use ($ads) {
                    $img->setAddId($ads->id);
                    return ['link' => $img->getLink(), 'add_id' => $ads->id];
                })->toArray();


            $ads->images()->insert($images);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $userId = Auth::id();
            $info = ["message" => "Не удалось создать объявление: {$olxAdvertisement->getOlx()} - ID пользователя: {$userId}"];
            Log::channel("create_ads")->error($info);
            return false;
        }

        $olxAdvertisement->setId($ads->id);
        $olxAdvertisement->setUserId($ads->user_id);
        $olxAdvertisement->setCreatedAt($ads->created_at);

        return $olxAdvertisement;
    }
}
