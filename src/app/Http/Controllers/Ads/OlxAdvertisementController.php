<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ads\AdsUpdateRequest;
use App\Modules\OlxAdvertisement\DTO\OlxAdvertisementToArrayDTO;
use App\Modules\OlxAdvertisement\Service\OlxAdvertisementService;
use Illuminate\Http\Request;

class OlxAdvertisementController extends Controller
{
    /**
     * @param Request $request
     * @param string $slug
     * @param OlxAdvertisementService $olxAdvertisementService
     */
    public function index(Request $request, string $slug, OlxAdvertisementService $olxAdvertisementService)
    {
        $ads = $olxAdvertisementService->find($slug);

        return is_null($ads)
            ? abort(404)
            : view("pages.ads.ads_view", [
            "ads" => OlxAdvertisementToArrayDTO::toArray($ads),
            "url" => route("olx.adds.edit", ["slug" => $slug]),
            "title" => $ads->getTitle(),
        ]);
    }

    public function edit(Request $request, string $slug, OlxAdvertisementService $olxAdvertisementService) {
        $ads = $olxAdvertisementService->find($slug);

        if(is_null($ads) || !$olxAdvertisementService->isOwner($ads)) {
            return abort(404);
        }

        return view("pages.ads.ads_edit", [
            "title" => $ads->getTitle(),
            "ads" => OlxAdvertisementToArrayDTO::toArray($ads),
            "url" => route("olx.adds.update", ["slug" => $slug]),
            "public_url_ads" => route("olx.adds.show", ["slug" => $slug]),
        ]);
    }

    public function update(AdsUpdateRequest $request, string $slug, OlxAdvertisementService $olxAdvertisementService) {
        $ads = $olxAdvertisementService->find($slug);

        if(is_null($ads) || !$olxAdvertisementService->isOwner($ads)) {
            return response()->json(["message" => "не можливо редагувати оголошення"], 422);
        }

        $data = $request->only(["title", "body", "price", "commentary", "images"]);

        return $olxAdvertisementService->update($ads, $data)
            ? response()->json(["message" => "OK"])
            : response()->json(["message" => "не вдалося оновити оголошення"], 500);
    }
}
