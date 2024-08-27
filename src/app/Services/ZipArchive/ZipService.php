<?php


namespace App\Services\ZipArchive;


use App\Modules\Client\Service\ActionClient;
use App\Services\SaveImage\SaveImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ZipService
{
    /**
     * @var ZipArchive
     */
    public ZipArchive $zip;
    /**
     * @var ActionClient
     */
    private ActionClient $client;

    private SaveImage $clientImages;


    /**
     * ZipService constructor.
     * @param ZipArchive $zip
     * @param ActionClient $client
     * @param SaveImage $clientImages
     */
    public function __construct(ZipArchive $zip, ActionClient $client, SaveImage $clientImages)
    {
        $this->zip = $zip;
        $this->client = $client;
        $this->clientImages = $clientImages;
    }


    /**
     * @param array $images
     * @param string|null $zipFileName
     * @return string
     * @throws \Exception
     */
    public function imagesToArchive(array $images, string $zipFileName = null): string
    {
        $this->removeUserFolderZip();

        $userId = $this->client->auth()->getId();

        if (is_null($zipFileName)) {
            $zipFileName = Str::uuid() . $userId;
        }

        $zipPath = Storage::disk("zip")->path("{$userId}/{$zipFileName}.zip");

        $this->createUserFolder($userId);

        if ($this->zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
            Log::channel("zip")->error("не вдалося створити архів для юзера з ID {$userId}");
            throw new \Exception("zip помилка");
        }

        foreach ($images as $img) {
            if (Storage::disk("images")->exists($img)) {
                $fileName = basename($img);
                $this->zip->addFile(Storage::disk("images")->path($img), $fileName);
            }
        }

        $this->zip->close();
        $this->clientImages->removeUserFolderImages();

        return Storage::disk("zip")->url("{$userId}/{$zipFileName}.zip");
    }

    /**
     * @param string $name
     */
    private function createUserFolder(string $name): void
    {
        if (!Storage::disk("zip")->exists($name)) {
            Storage::disk("zip")->makeDirectory($name);
        }
    }

    /**
     * @param int|null $userId
     */
    public function removeUserFolderZip(int $userId = null): void
    {
        if (is_null($userId) && $this->client->auth()) {
            $userId = $this->client->auth()->getId();
        }

        if (Storage::disk("zip")->exists($userId)) {
            Storage::disk("zip")->deleteDirectory($userId);
        }
    }
}
