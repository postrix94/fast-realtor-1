<?php


namespace App\Modules\OlxAdvertisement\Repository\Interfaces;



use App\Modules\OlxAdvertisement\OlxAdvertisement;

interface ReadOlxAdvertisement
{

    /**
     * @param string $slug
     * @return OlxAdvertisement|null
     */
    public function get(string $slug):OlxAdvertisement|null;
}
