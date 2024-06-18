<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function index() {
        return view("pages.home", [
            "title" => "Головна",
            "user" => Auth::user(),
            "olx_link" => route("olx.parser"),
        ]);
    }
}
