<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('web')
                ->group(base_path('routes/admin/web.php'));
            Route::middleware('web')
                ->group(base_path('routes/admin/api.php'));
            Route::middleware('web')
                ->group(base_path('routes/visitor/web.php'));
            Route::middleware('api')
                ->group(base_path('routes/api.php'));
        },
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'stripe/*',
            'http://localhost:3000/product/store',
            'http://localhost:3000/product/*',
            'http://localhost:5173/product/brands',
            'http://localhost:5173/brands/create',
            'http://localhost:5173/product/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
