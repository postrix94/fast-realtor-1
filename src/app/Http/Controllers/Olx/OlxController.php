<?php

namespace App\Http\Controllers\Olx;

use App\Events\SaveImagesEvent;
use App\Http\Controllers\Controller;
use App\Modules\Client\Service\ActionClient;
use App\Services\OlxParser\OlxParserService;
use App\Http\Requests\Olx\OlxRequest;
use App\Services\ZipArchive\ZipService;
use Illuminate\Support\Facades\Storage;


class OlxController extends Controller
{
    public function store(OlxRequest $request, OlxParserService $olxParserService, ZipService $zipService, ActionClient $client)
    {
        $ads = $olxParserService->getOlxAds($request->get('olx_link'));

        if ($client->isSaveImages() && $request->get("is_save_images", false)) {
            SaveImagesEvent::dispatch($ads->getImages());

            $images = Storage::disk('images')->files($client->auth()->getId());
            $zipPathDownload = $zipService->imagesToArchive($images);

            return response()->json(["link" => $ads->publicLink(), "zip" => $zipPathDownload, "remove_zip_path" => route("remove.zip.images")]);
        }

        return response()->json(["link" => $ads->publicLink()]);
    }
}
