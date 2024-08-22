<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ads\AdsUpdateRequest;
use App\Modules\Client\DTO\AdsPaginationDTO;
use App\Modules\Client\Service\ActionClient;
use App\Modules\OlxAdvertisement\DTO\OlxAdvertisementToArrayDTO;
use App\Modules\OlxAdvertisement\Service\OlxAdvertisementService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                "url" => route("olx.ads.edit", ["slug" => $slug]),
                "title" => $ads->getTitle(),
            ]);
    }

    public function all(Request $request)
    {
        return view("pages.ads.ads_all", ["title" => "Мої оголошення", "url" => route("olx.get.ads")]);
    }

    public function getAds(Request $request, ActionClient $client) {
        $limit = $request->get("limit", 15);
        $offset = $request->get("offset", 0);

        $paginateDTO = new AdsPaginationDTO($limit, $offset);
        $ads = $client->ads($paginateDTO);

        return response()->json(["ads" => $ads]);
    }

    public function edit(Request $request, string $slug, OlxAdvertisementService $olxAdvertisementService)
    {
        $ads = $olxAdvertisementService->find($slug);

        if (is_null($ads) || !$olxAdvertisementService->isOwner($ads)) {
            return abort(404);
        }

        return view("pages.ads.ads_edit", [
            "title" => $ads->getTitle(),
            "ads" => OlxAdvertisementToArrayDTO::toArray($ads),
            "url" => route("olx.ads.update", ["slug" => $slug]),
            "public_url_ads" => route("olx.ads.show", ["slug" => $slug]),
        ]);
    }

    public function update(AdsUpdateRequest $request, string $slug, OlxAdvertisementService $olxAdvertisementService)
    {
        $ads = $olxAdvertisementService->find($slug);

        if (is_null($ads) || !$olxAdvertisementService->isOwner($ads)) {
            return response()->json(["message" => "не можливо редагувати оголошення"], 422);
        }

        $data = $request->only(["title", "body", "price", "commentary", "images"]);

        return $olxAdvertisementService->update($ads, $data)
            ? response()->json(["message" => "OK"])
            : response()->json(["message" => "не вдалося оновити оголошення"], 500);
    }

    public function delete(Request $request, string $slug, OlxAdvertisementService $olxAdvertisementService) {
        $ads = $olxAdvertisementService->find($slug);

        if (is_null($ads) || !$olxAdvertisementService->isOwner($ads)) {
            return response()->json(["message" => "не можливо видалити оголошення"], 422);
        }

        return $olxAdvertisementService->delete($ads->getId())
            ? response()->json(["message" => "OK", "id" => $ads->getId()])
            : response()->json(["message" => "не вдалося видалити оголошення"], 500);
    }
}
