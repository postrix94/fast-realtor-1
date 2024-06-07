<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("pages.login");
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only(["phone", "password"]);

        if (!Auth::attempt($credentials)) {
            return response()->json(["message" => "Невірно введено логін або пароль"], 422);
        }

        if (Auth::user()->is_blocked) {
            return response()->json(["message" => "Ваш обліковий запис заблоковано"], 422);
        }

        $request->session()->regenerate();
        return response()->json(["message" => "success", "url" => route("home")]);
    }
}
