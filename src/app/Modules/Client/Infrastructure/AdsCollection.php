<?php


namespace App\Modules\Client\Infrastructure;


use App\Modules\OlxAdvertisement\OlxAdvertisement;

class AdsCollection
{
    /**
     * @var array
     */
    private array $ads = [];

    /**
     * @param OlxAdvertisement $ads
     */
    public function add(OlxAdvertisement $ads): void {
        $this->ads[] = $ads;
    }

    /**
     * @return array
     */
    public function get(): array {
        return $this->ads;
    }
}
