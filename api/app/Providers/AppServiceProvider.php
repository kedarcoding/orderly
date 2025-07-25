<?php

namespace App\Providers;

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //admin middleware registration in boot
        app()->make('router')->pushMiddlewareToGroup('api', CorsMiddleware::class);

    }
}
