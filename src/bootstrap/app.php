<?php

use App\Exceptions\CreateOlxAddException;
use App\Exceptions\OlxRequestException;
use App\Http\Middleware\Auth\AuthMiddleware;
use App\Http\Middleware\Guest\RedirectIfAuthenticated;
use App\Http\Middleware\RoleAndPermission\CheckRoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => CheckRoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        'guest' => RedirectIfAuthenticated::class,
        'auth' => AuthMiddleware::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (OlxRequestException $e) {
            return response()->json(["message" => "Помилка:( - спробуйте ще раз"], 422);
        });

        $exceptions->report(function (OlxRequestException $e) {
            Log::channel("olx_request")->error($e->getMessage());
            return false;
        });

        $exceptions->render(function (CreateOlxAddException $e) {
            return response()->json(["message" => "Помилка:( - спробуйте ще раз"], 422);
        });

        $exceptions->report(fn (CreateOlxAddException $e) => false);

    })->create();
