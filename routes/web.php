<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'login'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/signup', [SignupController::class, 'signup']);

Route::post('/signup', [SignupController::class, 'register']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/user', [UserController::class, 'dashboard'])->name('dashboard');

Route::post('/user/consumptions/add', [UserController::class, 'addConsumption']);

Route::fallback(function () {
    return abort(404);
});
