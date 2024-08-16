<?php


namespace App\Modules\OlxAdvertisement\Service;


use App\Modules\Client\Service\ActionClient;
use App\Modules\OlxAdvertisement\Infrastructure\Image;
use App\Modules\OlxAdvertisement\OlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\Interfaces\ReadOlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\Interfaces\WriteOlxAdvertisement;
use App\Services\OlxParser\DTO\OlxCrawlerDTO;
use Illuminate\Support\Collection;

class OlxAdvertisementService
{
    /**
     * @var WriteOlxAdvertisement
     */
    private WriteOlxAdvertisement $writeOlxAdvertisementRepository;
    /**
     * @var ReadOlxAdvertisement
     */
    private ReadOlxAdvertisement $readOlxAdvertisementRepository;
    /**
     * @var ActionClient
     */
    private ActionClient $actionClientService;


    /**
     * OlxAdvertisementService constructor.
     * @param WriteOlxAdvertisement $writeOlxAdvertisementRepository
     * @param ReadOlxAdvertisement $readOlxAdvertisementRepository
     * @param ActionClient $actionClientService
     */
    public function __construct(WriteOlxAdvertisement $writeOlxAdvertisementRepository,
                                ReadOlxAdvertisement $readOlxAdvertisementRepository,
                                ActionClient $actionClientService
    )
    {
        $this->writeOlxAdvertisementRepository = $writeOlxAdvertisementRepository;
        $this->readOlxAdvertisementRepository = $readOlxAdvertisementRepository;
        $this->actionClientService = $actionClientService;
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function isOwner(string $slug): bool
    {
        if(is_null($this->actionClientService->auth())) return false;

        dd($this->find($slug));
        return $this->find($slug)->client()->getId() === $this->actionClientService->auth()->getId();
    }

    /**
     * @param string $slug
     * @return OlxAdvertisement|null
     */
    public function find(string $slug): OlxAdvertisement|null
    {
        $ads = $this->readOlxAdvertisementRepository->get($slug);
        if(is_null($ads)) return null;

        $ads->is_owner = $this->isOwner($slug);

        dd($ads);


        return $ads;

    }

    /**
     * @param OlxCrawlerDTO $olxDTO
     * @return OlxAdvertisement|false
     */
    public function create(OlxCrawlerDTO $olxDTO): OlxAdvertisement|false
    {
        $imagesCollection = new Collection();

        foreach ($olxDTO->getImages() as $link) {
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

        return $this->writeOlxAdvertisementRepository->create($adsOlx);
    }

}
