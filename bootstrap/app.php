<?php

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
            'verify' => \App\Http\Middleware\CheckVerified::class,
            // 'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            // 'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'auth.guest' => \App\Http\Middleware\EnsureUserIsAuthenticated::class,
            'checkBanned' => \App\Http\Middleware\CheckBanned::class,
            'updatelastseen' => \App\Http\Middleware\UpdateLastSeen::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    