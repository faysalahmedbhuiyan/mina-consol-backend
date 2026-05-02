<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {

        $middleware->append(HandleCors::class);

    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();


$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| FIX STORAGE PATHS (Railway fix)
|--------------------------------------------------------------------------
*/

$paths = [
    $app->storagePath('framework/sessions'),
    $app->storagePath('framework/views'),
    $app->storagePath('framework/cache'),
];

foreach ($paths as $path) {
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

return $app;