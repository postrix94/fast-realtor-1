<?php

use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "guest"], function() {
    Route::get("login", [LoginController::class, "index"])->name("login");
    Route::post("login", [LoginController::class, "store"])->name("login.store");
});


Route::group(["middleware" => ["auth"],], function () {
    Route::get("/", function () {
        return view("welcome");
    })->name("home");


    Route::get("security", function () {
        return view("pages.security");
    });

    Route::get("all", function () {
        if (\Illuminate\Support\Facades\Gate::check("view-protected-part", [\App\Models\User::class])) {
            return view("pages.all");
        }

    });

});

