<?php

// Buka file bootstrap/app.php

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
        
        // ==> TAMBAHKAN ALIAS DI SINI <==
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        ]);

        // Anda juga bisa menambahkan middleware global atau grup di sini
        // Contoh:
        // $middleware->web(append: [
        //     \App\Http\Middleware\ExampleMiddleware::class,
        // ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();