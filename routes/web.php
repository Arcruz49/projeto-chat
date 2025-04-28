<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;


Route::get('/', [LoginController::class, 'Index'])->name('login');

Route::get('/register', [LoginController::class, 'Register'])->name('register');

Route::post('/register', [LoginController::class, 'RegisterUser'])->name('registerUser');

Route::post('/loginUser', [LoginController::class, 'LoginUser'])->name('loginUser');

Route::get('/home', [HomeController::class, 'Index'])->name('Home');

Route::get('/logout', [LoginController::class, 'LogOut'])->name('LogOut');
