<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\VerifyTokenMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // basic configuration api
        $middleware->group('api', [
            EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            'throttle:api',
            SubstituteBindings::class,
        ]);

        // alias for middleware
        $middleware->alias([
            'auth.sanctum' => \Laravel\Sanctum\Http\Middleware\Authenticate::class,
            'verify.token' => VerifyTokenMiddleware::class,
        ]);

        // group for api group middleware
        $middleware->group('auth.api', [
            'auth.sanctum',
            'verify.token',
        ]);

        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();