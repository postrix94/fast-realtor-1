<?php

namespace App\Http\Controllers;

use App\Modules\Client\DTO\ClientToArrayDTO;
use App\Modules\Client\Service\ActionClient;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(ActionClient $client)
    {
        return view("pages.home", [
            "title" => "Головна",
            "user" => ClientToArrayDTO::toArray($client->auth()),
            "olx_link" => route("olx.parser"),
        ]);
    }
}
