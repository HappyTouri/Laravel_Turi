<?php

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
// use Fruitcake\Cors\HandleCors;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'user' => \App\Http\Middleware\User::class,
            'lang' => App\Http\Middleware\LanguageManager::class,
            'cooperator' => App\Http\Middleware\CooperatorMiddleware::class,
            'csrf' => VerifyCsrfToken::class,
            'cors' => \Illuminate\Http\Middleware\HandleCors::class, // Register the CORS middleware
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
