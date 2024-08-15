<?php


namespace App\Services\OlxParser;

use App\Exceptions\CreateOlxAddException;
use App\Exceptions\OlxRequestException;
use App\Modules\OlxAdvertisement\Service\OlxAdvertisementService;
use App\Services\OlxParser\Infrastructure\OlxDOMCrawler;
use App\Services\OlxParser\Requests\OlxRequest;

class OlxParserService
{
    private OlxRequest $olxRequest;
    private OlxDOMCrawler $crawler;
    private OlxAdvertisementService $olxAdvertisementService;

    /**
     * OlxParserService constructor.
     * @param OlxRequest $olxRequest
     * @param OlxDOMCrawler $crawler
     * @param OlxAdvertisementService $olxAdvertisementService
     */
    public function __construct(OlxRequest $olxRequest, OlxDOMCrawler $crawler, OlxAdvertisementService $olxAdvertisementService)
    {
        $this->olxRequest = $olxRequest;
        $this->crawler = $crawler;
        $this->olxAdvertisementService = $olxAdvertisementService;
    }


    public function getPublicLink(string $url)
    {
        $response = $this->olxRequest::handle($this->removeQueryParams($url));

        if (!$response->isSuccess()) {
            throw new OlxRequestException("не вдалося получити відповідь за цим url: {$url}");
        }

        $olxDto = $this->crawler->parse($response);
        $olxDto->setOlx($this->removeQueryParams($url));

        $olxAds = $this->olxAdvertisementService->create($olxDto);

        if (!$olxAds) {
            throw new CreateOlxAddException("не вдалося створити оголошення url {$url}");
        }

        return $olxAds->publicLink();
    }

    /**
     * @param string $url
     * @return string
     */
    private function removeQueryParams(string $url): string
    {
        $result = explode("?", $url);
        return $result[0];
    }
}

