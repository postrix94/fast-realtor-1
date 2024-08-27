<?php

use App\Http\Controllers\Ads\OlxAdvertisementController;
use App\Http\Controllers\Download\ZipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Login\LoginAdminController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Logout\LogoutController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Olx\OlxController;
use Illuminate\Support\Facades\Route;

Route::middleware(["guest"])->group(function () {
    Route::get("login", [LoginController::class, "index"])->name("login");
    Route::post("login", [LoginController::class, "store"])->name("login.store");
});

//Route::name("admin.")->prefix("admin")->middleware(["guest:admin"])->group(function () {
//    Route::get("login", [LoginAdminController::class, "index"])->name("login");
//    Route::post("login", [LoginAdminController::class, "store"])->name("login.store");
//});


Route::group(["middleware" => ["auth"],], function () {
    Route::post("menu", MenuController::class);
    Route::post("logout", [LogoutController::class, "logout"])->name("logout");

    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::post("olx-parser", [OlxController::class, "store"])->name("olx.parser");
    Route::post('remove-zip', [ZipController::class, "removeImagesOlx"])->name("remove.zip.images");


    Route::prefix("olx")->name("olx.")->group(function () {
        Route::get("ads", [OlxAdvertisementController::class, "all"])->name("ads.all");
        Route::post("ads", [OlxAdvertisementController::class, "getAds"])->name("get.ads");

        Route::prefix("ads")->name("ads.")->group(function () {
            Route::get("{slug}/edit", [OlxAdvertisementController::class, "edit"])->name("edit");
            Route::post("{slug}/update", [OlxAdvertisementController::class, "update"])->name("update");
            Route::post("{slug}/delete", [OlxAdvertisementController::class, "delete"])->name("delete");
        });
    });

//    Route::get("all", function () {
//        return view("pages.all");
//    })->name("all");

});

Route::get("olx/ads/{slug}", [OlxAdvertisementController::class, "index"])->name("olx.ads.show");

//Route::get("security", function () {
//
//    if (\Illuminate\Support\Facades\Gate::check(["add-new-user", "view-user"], \Illuminate\Support\Facades\Auth::user())) {
//        return view("pages.security");
//    }
//
//    return abort(404);
//
//
//})->middleware(["auth:admin", "role:super_admin"])->name("security");

Route::fallback(fn() => abort(404));
