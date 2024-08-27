<?php

use App\Http\Middleware\Auth\AuthMiddleware;
use App\Http\Middleware\Guest\RedirectIfAuthenticated;
use App\Http\Middleware\RoleAndPermission\CheckRoleMiddleware;

return [
    'role' => CheckRoleMiddleware::class,
    'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    'guest' => RedirectIfAuthenticated::class,
    'auth' => AuthMiddleware::class,
];
