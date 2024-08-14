<?php


namespace App\Services\OlxParser;

use App\Exceptions\OlxRequestException;
use App\Services\OlxParser\Infrastructure\OlxDOMCrawler;
use App\Services\OlxParser\Requests\OlxRequest;

class OlxParserService
{
    private OlxRequest $olxRequest;
    private OlxDOMCrawler $crawler;

    /**
     * OlxParserService constructor.
     * @param OlxRequest $olxRequest
     * @param OlxDOMCrawler $crawler
     */
    public function __construct(OlxRequest $olxRequest, OlxDOMCrawler $crawler)
    {
        $this->olxRequest = $olxRequest;
        $this->crawler = $crawler;
    }

    public function getPublicLink(string $url) {
       $response = $this->olxRequest::handle($this->removeQueryParams($url));

       if(!$response->isSuccess()) {
           throw new OlxRequestException("Помилка:( - спробуйте ще раз ");
       }

       $olxDto = $this->crawler->parse($response);
       $olxDto->olx = $url;

       dd($olxDto);

    }

    /**
     * @param string $url
     * @return string
     */
    private function removeQueryParams(string $url): string {
        $result = explode("?", $url);
        return $result[0];
    }
}

