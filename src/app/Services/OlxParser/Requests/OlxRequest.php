<?php

namespace App\Services\OlxParser\Requests;

use App\Services\OlxParser\DTO\ResponseOlxDTO;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class OlxRequest
{
    /**
     * @param string $url
     * @return ResponseOlxDTO
     */
    public static function handle(string $url): ResponseOlxDTO
    {
        try {
            $response = Http::withHeaders(self::headers())->asForm()->get($url);

            if ($response->status() !== 200 || $response->body() === "") {
                return new ResponseOlxDTO(statusCode: $response->status());
            }

        } catch (\Exception $e) {
            $info = ["link" => $url, "message" => $e->getMessage()];
            Log::channel("olx_request")->error(json_encode($info));

            return new ResponseOlxDTO(statusCode: $e->getCode());
        }

        return new ResponseOlxDTO(html: $response->body(), statusCode: $response->status());
    }

    /**
     * @return array
     */
    private static function headers(): array
    {
        return [
            'authority' => 'www.olx.ua',
            'scheme' => 'https',
            'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'accept-language' => 'ru,en-US;q=0.9,en-GB;q=0.8,en;q=0.7,uk;q=0.6,de-DE;q=0.5,de-LI;q=0.4,de;q=0.3,ru-RU;q=0.2,de-CH;q=0.1,en-GB-oxendict;q=0.1',
            'cache-control' => 'max-age=0',
            'cookie' => 'lang=uk',
            'referer' => 'https://www.olx.ua/',
            'sec-ch-ua-mobile' => '?0',
            'sec-fetch-dest' => 'document',
            'sec-fetch-mode' => 'navigate',
            'sec-fetch-site' => 'same-origin',
            'sec-fetch-user' => '?1',
            'user-agent' => self::getUserAgent(),
        ];
    }

    /**
     * @return string
     */
    private static function getUserAgent(): string
    {
        $headers = Config::get('headers');
        $max = count($headers) - 1;
        $index = rand(0, $max);
        return $headers[$index];
    }
}
