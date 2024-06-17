<?php

namespace App\Http\Middleware\RoleAndPermission;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, array|string ...$role): Response
    {
        if(!is_null($request->user()) && $request->user()->hasRole($role)) {
            return $next($request);
        }

        return abort(404);
    }
}
