<?php


namespace App\Services\OlxParser\DTO;


class OlxCrawlerDTO
{
    private const LENGTH_BODY = 30000;
    private const LENGTH_OLX_URL = 300;

    private string $id;
    private string $title;
    private string $slug;
    private string $body;
    private string $price;
    private string $ownerName;
    private array $informationApartment;
    private array $images;
    private string $olx;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $this->lengthValidationValue($id);
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
        $this->title = $this->lengthValidationValue($title);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $this->lengthValidationValue($slug);
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
        $this->body = $this->lengthValidationValue($body, self::LENGTH_BODY);
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
        $this->price = $this->lengthValidationValue($price);
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
        $this->ownerName = $this->lengthValidationValue($ownerName);;
    }

    /**
     * @return array
     */
    public function getInformationApartment(): array
    {
        return $this->informationApartment;
    }

    /**
     * @param array $informationApartment
     */
    public function setInformationApartment(array $informationApartment): void
    {
        foreach ($informationApartment as $index => $information) {
            $informationApartment[$index] = $this->lengthValidationValue($information);
        }

        $this->informationApartment = $informationApartment;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        foreach ($images as $index => $image) {
            $images[$index] = $this->lengthValidationValue($image, self::LENGTH_OLX_URL);
        }

        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getOlx(): string
    {
        return $this->olx;
    }

    /**
     * @param string $olx
     */
    public function setOlx(string $olx): void
    {
        $this->olx = $this->lengthValidationValue($olx, self::LENGTH_OLX_URL);
    }

    /**
     * @param string $value
     * @param int $length
     * @return string
     */
    private function lengthValidationValue(string $value, int $length = 255): string
    {
        return substr($value, 0, $length);
    }


}
