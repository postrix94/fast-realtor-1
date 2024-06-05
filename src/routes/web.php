<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("security", function () {
    return view("pages.security");
});

Route::get("all", function () {

    if(\Illuminate\Support\Facades\Gate::check("view-protected-part", [\App\Models\User::class])) {
        return view("pages.all");
    }



});
Route::get("login", function () {
    return view("pages.login");
});
