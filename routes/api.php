<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;

Route::prefix('restaurants')->group(function () {
    Route::middleware(['custom-auth'])->group(function () {
        Route::post('/', [RestaurantController::class, 'store']);
        Route::patch('/{id}', [RestaurantController::class, 'update']);
        Route::delete('/{id}', [RestaurantController::class, 'destroy']);
    });
    
    Route::get('/', [RestaurantController::class, 'index']);
    Route::get('/{id}', [RestaurantController::class, 'show']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/', [UserController::class, 'store']);
    Route::patch('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

