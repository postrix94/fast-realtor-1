<?php

use App\Exceptions\CreateOlxAddException;
use App\Exceptions\OlxRequestException;

$exceptions->render(function (OlxRequestException $e) {
    return response()->json(["message" => "Помилка:( - спробуйте ще раз"], 422);
});

$exceptions->report(function (OlxRequestException $e) {
    Log::channel("olx_request")->error($e->getMessage());
    return false;
});

$exceptions->render(function (CreateOlxAddException $e) {
    return response()->json(["message" => "Помилка:( - спробуйте ще раз"], 422);
});

$exceptions->report(fn (CreateOlxAddException $e) => false);
