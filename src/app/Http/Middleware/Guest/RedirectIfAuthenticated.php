<?php

namespace App\Http\Middleware\Guest;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
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
            switch ($guard) {
                case "admin":
                    return redirect()->route("security");
                default:
                    return redirect()->route("home");
            }
        }

        return $next($request);
    }
}
