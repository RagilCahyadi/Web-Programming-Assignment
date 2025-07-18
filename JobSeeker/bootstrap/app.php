<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'redirect.if.authenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'auth.society' => \App\Http\Middleware\AuthenticateSociety::class,
            'auth.admin' => \App\Http\Middleware\AuthenticateAdmin::class,
            'auth.api' => \App\Http\Middleware\AuthenticateApi::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
