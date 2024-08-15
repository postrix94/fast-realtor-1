<?php


namespace App\Modules\OlxAdvertisement;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

class OlxAdvertisement
{
    private int $id;
    private string $title;
    private string $slug;
    private string $body;
    private string $price;
    private string $ownerName;
    private string $information;
    private string $adId;
    private string $olx;
    private string $commentary;
    private ?int $userId;
    private Collection $images;


    /**
     * OlxAdvertisement constructor.
     * @param int $id
     * @param string $title
     * @param string $slug
     * @param string $body
     * @param string $price
     * @param string $ownerName
     * @param string $information
     * @param string $adId
     * @param string $commentary
     * @param string $olx
     * @param Collection $images
     * @param int|null $userId
     */
    public function __construct(int $id, string $title, string $slug, string $body,
                                string $price, string $ownerName, string $information,
                                string $adId, string $commentary, string $olx, Collection $images,
                                ?int $userId = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->body = $body;
        $this->price = $price;
        $this->ownerName = $ownerName;
        $this->information = $information;
        $this->adId = $adId;
        $this->olx = $olx;
        $this->commentary = $commentary;
        $this->images = $images;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function publicLink(): string
    {
        $url = Config::get("app.url") . "/test/" . $this->slug;
        return $url;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    /**
     * @param string $ownerName
     */
    public function setOwnerName(string $ownerName): void
    {
        $this->ownerName = $ownerName;
    }

    /**
     * @return string
     */
    public function getInformation(): string
    {
        return $this->information;
    }

    /**
     * @param string $information
     */
    public function setInformation(string $information): void
    {
        $this->information = $information;
    }

    /**
     * @return string
     */
    public function getAdId(): string
    {
        return $this->adId;
    }

    /**
     * @return string
     */
    public function getOlx(): string
    {
        return $this->olx;
    }

    /**
     * @return string
     */
    public function getCommentary(): string
    {
        return $this->commentary;
    }

    /**
     * @param string $commentary
     */
    public function setCommentary(string $commentary): void
    {
        $this->commentary = $commentary;
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

}
