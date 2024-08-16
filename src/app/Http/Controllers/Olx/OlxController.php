<?php

namespace App\Http\Controllers\Olx;
use App\Http\Controllers\Controller;
use App\Services\OlxParser\OlxParserService;
use App\Http\Requests\Olx\OlxRequest;


class OlxController extends Controller
{
    public function store(OlxRequest $request, OlxParserService $olxParserService) {
        $link = $olxParserService->getPublicLink($request->get('olx_link'));
        return response()->json(compact('link'));
    }
}
