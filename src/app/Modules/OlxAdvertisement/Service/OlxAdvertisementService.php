<?php


namespace App\Modules\OlxAdvertisement\Service;


use App\Modules\OlxAdvertisement\Infrastructure\Image;
use App\Modules\OlxAdvertisement\OlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\Interfaces\WriteOlxAdvertisement ;
use App\Services\OlxParser\DTO\OlxCrawlerDTO;
use Illuminate\Database\Eloquent\Collection;

class OlxAdvertisementService
{
    /**
     * @var WriteOlxAdvertisement
     */
    private WriteOlxAdvertisement $writeOlxAdvertisementRepository;

    /**
     * OlxAdvertisementService constructor.
     * @param WriteOlxAdvertisement $writeOlxAdvertisementRepository
     */
    public function __construct(WriteOlxAdvertisement $writeOlxAdvertisementRepository)
    {
        $this->writeOlxAdvertisementRepository = $writeOlxAdvertisementRepository;
    }


    /**
     * @param OlxCrawlerDTO $olxDTO
     * @return OlxAdvertisement|false
     */
    public function create(OlxCrawlerDTO $olxDTO): OlxAdvertisement|false {
        $imagesCollection = new Collection();

        foreach($olxDTO->getImages() as $link) {
            $imagesCollection->add(new Image($link));
        }

        $adsOlx = new OlxAdvertisement(
             0,
            $olxDTO->getTitle(),
            $olxDTO->createSlug(),
            $olxDTO->getBody(),
            $olxDTO->getPrice(),
            $olxDTO->getOwnerName(),
            $olxDTO->getInformationApartment(),
            $olxDTO->getAdsId(),
            "",
            $olxDTO->getOlx(),
            $imagesCollection,
        );

        return  $this->writeOlxAdvertisementRepository->create($adsOlx);
    }

}
