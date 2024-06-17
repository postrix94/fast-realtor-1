<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Login\LoginAdminController;
use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(["guest"])->group(function () {
    Route::get("login", [LoginController::class, "index"])->name("login");
    Route::post("login", [LoginController::class, "store"])->name("login.store");
});

Route::name("admin.")->prefix("admin")->middleware(["guest:admin"])->group(function () {
    Route::get("login", [LoginAdminController::class, "index"])->name("login");
    Route::post("login", [LoginAdminController::class, "store"])->name("login.store");
});


Route::group(["middleware" => ["auth"],], function () {
    Route::get("/", [HomeController::class, "index"])->name("home");

    Route::get("all", function () {
        return view("pages.all");
    })->name("all");

});

Route::get("security", function () {

    if (\Illuminate\Support\Facades\Gate::check(["add-new-user", "view-user"], \Illuminate\Support\Facades\Auth::user())) {
        return view("pages.security");
    }

    return abort(404);


})->middleware(["auth:admin", "role:super_admin"])->name("security");
