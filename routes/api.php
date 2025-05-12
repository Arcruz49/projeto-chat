<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApiController;

Route::post('/loginDir', [LoginController::class, 'loginDir']);

Route::middleware('auth:api')->get('/perfil', function () {
    return response()->json(auth('api')->user());
});

Route::middleware('auth:api')->post('/alterar-senha', [ApiController::class, 'AlterarSenha']);
