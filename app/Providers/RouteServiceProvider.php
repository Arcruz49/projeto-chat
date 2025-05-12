<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Registra as rotas para o aplicativo.
     *
     * @return void
     */
    public function boot()
    {
        // Registra as rotas da API com o namespace diretamente na configuração
        Route::prefix('api')
            ->middleware('api')
            ->namespace('App\\Http\\Controllers')  // Define o namespace diretamente
            ->group(base_path('routes/api.php'));

        // Registra as rotas da Web (caso tenha)
        Route::middleware('web')
            ->namespace('App\\Http\\Controllers')  // Define o namespace diretamente
            ->group(base_path('routes/web.php'));
    }
}
