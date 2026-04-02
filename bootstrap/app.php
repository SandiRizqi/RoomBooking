<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Deteksi apakah running di Vercel (filesystem read-only)
$isVercel = isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL');

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'v1',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

if ($isVercel) {
    // Di Vercel: redirect storage dan bootstrap cache ke /tmp (satu-satunya folder writable)
    $app->useStoragePath('/tmp/storage');

    // Override bootstrap path tapi tetap pakai basePath yang benar
    // Ini memaksa PackageManifest menulis ke /tmp bukan ke /var/task/user/bootstrap/cache
    $app->instance('path.bootstrap', '/tmp/vercel-bootstrap');
    
    // Pastikan direktori sudah ada
    @mkdir('/tmp/vercel-bootstrap/cache', 0775, true);
    @mkdir('/tmp/storage/framework/cache/data', 0775, true);
    @mkdir('/tmp/storage/framework/sessions', 0775, true);
    @mkdir('/tmp/storage/framework/views', 0775, true);
    @mkdir('/tmp/storage/logs', 0775, true);
    @mkdir('/tmp/storage/app/public', 0775, true);
}

return $app;
