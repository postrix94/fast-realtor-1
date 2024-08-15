<?php


namespace App\Services\OlxParser\Infrastructure;


use App\Services\OlxParser\DTO\OlxCrawlerDTO;
use App\Services\OlxParser\DTO\ResponseOlxDTO;
use Symfony\Component\DomCrawler\Crawler;

class OlxDOMCrawler
{
    private Crawler $crawler;
    private DomSelectors $selectors;
    private OlxCrawlerDTO $olxCrawlerDTO;


    /**
     * OlxDOMCrawler constructor.
     * @param Crawler $crawler
     * @param DomSelectors $selectors
     * @param OlxCrawlerDTO $olxCrawlerDTO
     */
    public function __construct(Crawler $crawler, DomSelectors $selectors, OlxCrawlerDTO $olxCrawlerDTO)
    {
        $this->crawler = $crawler;
        $this->selectors = $selectors;
        $this->olxCrawlerDTO = $olxCrawlerDTO;
    }

    /**
     * @param ResponseOlxDTO $olxDto
     * @return OlxCrawlerDTO
     */
    public function parse(ResponseOlxDTO $olxDto): OlxCrawlerDTO
    {
        $this->crawler->addHtmlContent($olxDto->getHtml());
        $this->getInformation();

        return $this->olxCrawlerDTO;
    }

    private function getInformation(): void
    {
        $titleNode = $this->crawler->filter($this->selectors->cssClassHeader)->first();
        $this->olxCrawlerDTO->setTitle($titleNode->text(""));

        $priceNode = $this->crawler->filter($this->selectors->cssClassPrice)->first();
        $this->olxCrawlerDTO->setPrice($priceNode->text(""));

        $bodyNode = $this->crawler->filter($this->selectors->cssClassBody)->first();
        $this->olxCrawlerDTO->setBody($bodyNode->text(""));

        $ownerNode = $this->crawler->filter($this->selectors->cssOwnerName)->first();
        $this->olxCrawlerDTO->setOwnerName($ownerNode->text("No name"));

        $this->olxCrawlerDTO->setInformationApartment($this->informationApartment());

        $addId = $this->crawler->filter($this->selectors->cssClassAddId)->first();
        $adsId = $addId->text("")
            ? trim(explode(":", $addId->text(""))[1])
            : $addId->text("");

        $this->olxCrawlerDTO->setId($adsId);


        $this->olxCrawlerDTO->setImages($this->getImages());

    }

    /**
     * @return array
     */
    private function informationApartment(): array
    {
        $informationNode = $this->crawler->filter($this->selectors->cssClassTechnicalInformation);
        $listInfo = [];

        $informationNode->each(function (Crawler $liEl) use (&$listInfo) {

            $regex_floor = "/^Поверховість:/";
            if (preg_match($regex_floor, $liEl->text(""))) {
                $listInfo[] = $liEl->text("");
            }

            $regex_number_of_storeys = "/^Поверх:/";
            if (preg_match($regex_number_of_storeys, $liEl->text(""))) {
                $listInfo[] = $liEl->text("");
            }

            $regex_area = "/^Загальна площа:/";
            if (preg_match($regex_area, $liEl->text(""))) {
                $listInfo[] = $liEl->text("");
            }

            $regex_number_of_rooms = "/^Кількість кімнат:/";
            if (preg_match($regex_number_of_rooms, $liEl->text(""))) {
                $listInfo[] = $liEl->text("");
            }
        });

        return $listInfo;
    }

    /**
     * @return array
     */
    private function getImages(): array {
        $imagesNode = $this->crawler->filter($this->selectors->cssClassImages);
        $images = [];

        $imagesNode->each(function (Crawler $img) use (&$images) {
            if($link = $img->attr("src")) {
                $images[] = $link;
            }
        });

        return $images;
    }
}
