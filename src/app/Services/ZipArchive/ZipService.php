<?php


namespace App\Services\ZipArchive;


use App\Modules\Client\Service\ActionClient;
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


    /**
     * ZipService constructor.
     * @param ZipArchive $zip
     * @param ActionClient $client
     */
    public function __construct(ZipArchive $zip, ActionClient $client)
    {
        $this->zip = $zip;
        $this->client = $client;
    }


    public function imagesToArchive(array $images)
    {
        $zipFileName = Str::uuid() . $this->client->auth()->getId() . '.zip';
        $zipPath = Storage::disk("zip")->path("{$this->client->auth()->getId()}/{$zipFileName}");


        if(!Storage::disk("zip")->exists("1")) {
            Storage::disk("zip")->makeDirectory("1");
        }

        if ($this->zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
            dd("hi");
            return;
        }

        foreach ($images as $img) {
            if (Storage::disk("images")->exists($img)) {
                $fileName = basename($img);
                $this->zip->addFile(Storage::disk("images")->path($img), $fileName);
            }
        }

        $this->zip->close();
    }
}
