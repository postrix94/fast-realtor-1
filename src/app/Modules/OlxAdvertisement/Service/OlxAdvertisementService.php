<?php


namespace App\Modules\OlxAdvertisement\Service;


use App\Modules\Client\Service\ActionClient;
use App\Modules\OlxAdvertisement\Infrastructure\Image;
use App\Modules\OlxAdvertisement\OlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\Interfaces\ReadOlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\Interfaces\WriteOlxAdvertisement;
use App\Services\OlxParser\DTO\OlxCrawlerDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
     * @param OlxAdvertisement $ads
     * @return bool
     */
    public function isOwner(OlxAdvertisement $ads): bool
    {
        if (is_null($this->actionClientService->auth())) return false;

        return $ads->client()->getId() === $this->actionClientService->auth()->getId();
    }

    /**
     * @param string $slug
     * @return OlxAdvertisement|null
     */
    public function find(string $slug): OlxAdvertisement|null
    {
        $ads = $this->readOlxAdvertisementRepository->get($slug);
        if (is_null($ads)) return null;

        $ads->setIsOwner($this->isOwner($ads));

        return $ads;
    }

    /**
     * @param OlxAdvertisement $ads
     * @param array $data
     * @return bool
     */
    public function update(OlxAdvertisement $ads, array $data): bool
    {
        $ads->setTitle($data['title']);

        $ads->setBody($data['body']);
        $ads->setPrice($data['price']);
        $ads->setCommentary($data["commentary"]);

        $imagesCollection = $this->createImageCollection($data["images"]);
        $diffImages = $ads->getImages()->filter(fn($img) => in_array($img, $imagesCollection->toArray()));
        $ads->setImages($diffImages);

        $isUpdate = $this->writeOlxAdvertisementRepository->update($ads);

       return $isUpdate;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id):bool {
        return $this->writeOlxAdvertisementRepository->delete($id);
    }

    /**
     * @param OlxCrawlerDTO $olxDTO
     * @return OlxAdvertisement|false
     */
    public function create(OlxCrawlerDTO $olxDTO): OlxAdvertisement|false
    {
        $slug = $this->createSlug($olxDTO->getTitle(), $olxDTO->getAdsId());
        $olxDTO->setSlug($slug);

        $adsOlx = new OlxAdvertisement(
            0,
            $olxDTO->getTitle(),
            $olxDTO->getSlug(),
            $olxDTO->getBody(),
            $olxDTO->getPrice(),
            $olxDTO->getOwnerName(),
            $olxDTO->getInformationApartment(),
            $olxDTO->getAdsId(),
            "",
            $olxDTO->getOlx(),
            $this->createImageCollection($olxDTO->getImages()),
        );

        return $this->writeOlxAdvertisementRepository->create($adsOlx);
    }


    /**
     * @param string $title
     * @param string $adsId
     * @return string
     */
    private function createSlug(string $title, string $adsId): string
    {
        $title = substr($title, 0, 255);
        $slug = Str::slug($title . " " . Str::uuid() . $adsId);

        return $slug;
    }

    /**
     * @param array $images
     * @return Collection
     */
    private function createImageCollection(array $images): Collection
    {
        $imagesCollection = new Collection();

        foreach ($images as $img) {
            if (is_array($img)) {
                $imagesCollection->add(new Image($img["link"], $img["id"], $img["add_id"]));
            } else {
                $imagesCollection->add(new Image($img));
            }
        }

        return $imagesCollection;
    }

}
