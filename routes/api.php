<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApiController;

Route::post('/loginDir', [LoginController::class, 'loginDir']);

Route::post('/registerDir', [ApiController::class, 'RegisterUser']);

Route::middleware('auth:api')->get('/perfil', function () {
    return response()->json(auth('api')->user());
});


Route::middleware('auth:api')->get('/perfil', function () {
    return response()->json(auth('api')->user());
});

Route::middleware('auth:api')->post('/alterar-senha', [ApiController::class, 'AlterarSenha']);

Route::middleware('auth:api')->get('/friend-requests', [ApiController::class, 'GetFriendsRequests']);

Route::middleware('auth:api')->get('/getChats', [ApiController::class, 'GetChats']);

Route::middleware('auth:api')->get('/searchUsers', [ApiController::class, 'searchUsers']);

Route::middleware('auth:api')->post('/sendFriendRequest', [ApiController::class, 'SendFriendRequest']);

Route::middleware('auth:api')->post('/acceptFriendRequest', [ApiController::class, 'AcceptFriendRequest']);

Route::middleware('auth:api')->post('/rejectFriendRequest', [ApiController::class, 'RejectFriendRequest']);

Route::middleware('auth:api')->post('/uploadProfileImage', [ApiController::class, 'UploadProfileImage']);

Route::middleware('auth:api')->get('/chat/{cdUsuarioAmigo}', [ApiController::class, 'OpenChat']);

Route::middleware('auth:api')->post('/chat/send', [ApiController::class, 'SendMessage']);