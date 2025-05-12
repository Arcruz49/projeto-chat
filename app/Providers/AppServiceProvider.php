<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\RouteServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registro do RouteServiceProvider
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Aqui vai a lógica de inicialização
    }
}

