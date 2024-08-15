<?php

namespace App\Http\Controllers;
use App\Services\OlxParser\OlxParserService;
use App\Http\Requests\Olx\OlxRequest;
use Illuminate\Http\Request;

class OlxController extends Controller
{
    public function store(OlxRequest $request, OlxParserService $olxParserService) {
        return response()->json(['link' => $olxParserService->getPublicLink($request->get('olx_link'))]);
    }
}
