<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Didaftarkan ke grup 'web' (bukan append() global) supaya route sudah
        // ter-resolve saat middleware ini jalan — dibutuhkan supaya CacheResponse
        // bisa mengecek middleware DoNotCacheResponse pada route saat ini.
        $middleware->web(append: [\App\Http\Middleware\CacheResponse::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
