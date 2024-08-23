<?php


namespace App\Modules\Client\DTO;


class AdsSearchDTO
{
    public ?string $title;
    public ?string $body;

    /**
     * AdsSearchDTO constructor.
     * @param array|null $search
     */
    public function __construct(?array $search)
    {
       $this->title = $search['title'] ?? null;
       $this->body = $search['title'] ?? null;
    }

    /**
     * @return bool
     */
    public function issetSearch(): bool {
        $filtered = array_filter(get_object_vars($this), fn($value) => $value !== null);

        return (bool) count($filtered);
    }
}
