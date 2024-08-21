<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Modules\Client\Service\ActionClient;

class MenuController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ActionClient $client)
    {
        if ($client->auth()) {

            return response()->json(["menu" => [
                "my_ads" => route("olx.ads.all"),
                "home" => route("home"),
                "logout" => route("logout"),
            ]]);
        }

        return response()->json(["message" => "no authenticate", 401]);
    }
}
