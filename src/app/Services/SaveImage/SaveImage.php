<?php


namespace App\Services\SaveImage;


use App\Modules\Client\Service\ActionClient;
use App\Services\SaveImage\Request\SaveImageRequest;
use Illuminate\Support\Facades\Http;
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
        $img = SaveImageRequest::handle($url);

        if (!$img) {
            return;
        }

        $userDirectory = $this->client->auth()->getId();

        if (is_null($filename)) {
            $filename = Str::uuid() . $this->client->auth()->getId();
        }

        Storage::disk('images')->put($userDirectory . "/" . $filename . ".webp", $img);
    }


    public function removeUserFolderImages(): void
    {
        $userId = $this->client->auth()->getId();

        if (Storage::disk("images")->exists($userId)) {
            Storage::disk("images")->deleteDirectory($userId);
        }
    }

}
