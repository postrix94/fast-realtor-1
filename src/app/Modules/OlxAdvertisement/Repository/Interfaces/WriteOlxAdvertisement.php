<?php


namespace App\Modules\OlxAdvertisement\Repository\Interfaces;


use App\Modules\OlxAdvertisement\OlxAdvertisement;

interface WriteOlxAdvertisement
{

    /**
     * @param OlxAdvertisement $olxAdvertisement
     * @return OlxAdvertisement|false
     */
    public function create(OlxAdvertisement $olxAdvertisement): false|OlxAdvertisement;


    /**
     * @param OlxAdvertisement $olxAdvertisement
     * @return bool
     */
    public function update(OlxAdvertisement $olxAdvertisement): bool;
}
