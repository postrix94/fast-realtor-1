<?php


namespace App\Modules\OlxAdvertisement\Infrastructure;


class Image
{
    private ?int $id;
    private string $link;
    private ?int $add_id;

    /**
     * Image constructor.
     * @param int|null $id
     * @param string $link
     * @param int|null $add_id
     */
    public function __construct(string $link, ?int $id = null, ?int $add_id = null)
    {
        $this->id = $id;
        $this->link = $link;
        $this->add_id = $add_id;
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
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return int
     */
    public function getAddId(): int
    {
        return $this->add_id;
    }

    /**
     * @param int $add_id
     */
    public function setAddId(int $add_id): void
    {
        $this->add_id = $add_id;
    }


}
