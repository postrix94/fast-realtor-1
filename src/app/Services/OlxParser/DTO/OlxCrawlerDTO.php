<?php


namespace App\Services\OlxParser\DTO;


class OlxCrawlerDTO
{
    public string $id;
    public string $title;
    public string $body;
    public string $price;
    public string $ownerName;
    public array $informationApartment;
    public array $images;
    public string $olx;
}
