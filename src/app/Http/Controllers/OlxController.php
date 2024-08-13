<?php

namespace App\Http\Controllers;
use App\Services\OlxParser\Requests\OlxRequest as OlxParser;

use App\Http\Requests\Olx\OlxRequest;
use Illuminate\Http\Request;

class OlxController extends Controller
{
    public function store(OlxRequest $request) {

        $r = OlxParser::handle($request->get('olx_link'));

        dd($r);
    }
}
