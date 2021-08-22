<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::post('/login', [UserController::class, 'login']);
Route::post('/signup', [UserController::class, 'signup']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'profile']);
    Route::get('/user/drinks', [UserController::class, 'getDrinks']);
    Route::get('/user/consumptions', [UserController::class, 'consumptions']);
    Route::post('/user/consumptions/add', [UserController::class, 'addConsumption']);
    Route::delete('/user/consumptions/delete', [UserController::class, 'removeConsumption']);
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::any('{any}', function () {
    return response(['message' =>  'Not found'], Response::HTTP_NOT_FOUND);
})->where('any', '.*');
