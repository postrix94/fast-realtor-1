<?php

namespace App\Http\Controllers;

use App\Http\Requests\Olx\OlxRequest;
use Illuminate\Http\Request;

class OlxController extends Controller
{
    public function store(OlxRequest $request) {
        dd($request->all());
    }
}
