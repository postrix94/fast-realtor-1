<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ads\AdsUpdateRequest;
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

    public function all(Request $request, ActionClient $client)
    {
        $ads = Auth::user()->adds()->orderBy("created_at", "DESC")->get()->map(function ($value) {
            $value->public_url_ads = route("olx.ads.show", ["slug" => $value->slug]);
            $value->edit_url_ads = route("olx.ads.edit", ["slug" => $value->slug]);
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('Y-m-d');

            $value->created = $date;

            return $value;
        });

        return view("pages.ads.ads_all", ["title" => "Мої оголошення", "ads" => $ads]);
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
}
