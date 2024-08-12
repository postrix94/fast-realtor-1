<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view("pages.login.login_admin");
    }

    /**
     * @param LoginAdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginAdminRequest $request)
    {
        $credentials = $request->only(["phone", "password"]);

        if (!Auth::guard("admin")->attempt($credentials)) {
            return response()->json(["message" => "Невірно введено логін або пароль"], 422);
        }

        if(!Auth::guard("admin")->user()->hasRole(["admin", "super_admin"])) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(["message" => "Невірно введено логін або пароль"], 422);
        }

        if (Auth::guard("admin")->user()->is_blocked) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(["message" => "Ваш обліковий запис заблоковано"], 422);
        }

        Auth::attempt($credentials);
        $request->session()->regenerate();

        return response()->json(["message" => "success", "url" => route("security")]);
    }
}
