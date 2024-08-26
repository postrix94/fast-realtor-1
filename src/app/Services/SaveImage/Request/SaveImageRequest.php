<?php


namespace App\Services\SaveImage\Request;


use Illuminate\Support\Facades\Http;

class SaveImageRequest
{
    /**
     * @param string $url
     * @return false|string
     */
    public static function handle(string $url): string|false
    {
        try {
            $response = Http::get($url);

            if ($response->ok()) {
                return $response->body();
            }

        } catch (\Exception $e) {
            return false;
        }

        return false;
    }
}
