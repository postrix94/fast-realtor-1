<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string $guard
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $guard = "web"): Response
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }

        switch ($guard) {
            case "admin":
                return redirect()->route("admin.login");
            default:
                return redirect()->route("login");
        }
    }
}
