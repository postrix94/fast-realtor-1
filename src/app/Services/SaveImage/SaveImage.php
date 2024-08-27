<?php


namespace App\Services\SaveImage;


use App\Modules\Client\Service\ActionClient;
use App\Services\OlxParser\Requests\OlxRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SaveImage
{
    /**
     * @var ActionClient
     */
    private ActionClient $client;

    /**
     * SaveImage constructor.
     * @param ActionClient $client
     */
    public function __construct(ActionClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     * @param string|null $filename
     */
    public function save(string $url, ?string $filename = null)
    {
        $responseDTO = OlxRequest::handle($url);

        if (!$responseDTO->isSuccess()) {
            return;
        }

        $userDirectory = $this->client->auth()->getId();

        if (is_null($filename)) {
            $filename = Str::uuid() . $this->client->auth()->getId();
        }

        Storage::disk('images')->put($userDirectory . "/" . $filename . ".webp", $responseDTO->getResponse());
    }


    /**
     * @param int|null $userId
     */
    public function removeUserFolderImages(int $userId = null): void
    {
        if (is_null($userId) && $this->client->auth()) {
            $userId = $this->client->auth()->getId();
        }

        if (Storage::disk("images")->exists($userId)) {
            Storage::disk("images")->deleteDirectory($userId);
        }
    }

}
