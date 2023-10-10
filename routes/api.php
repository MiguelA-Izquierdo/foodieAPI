<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Restaurants
Route::prefix('restaurants')->group(function () {
    Route::get('/', 'App\Http\Controllers\RestaurantController@index');
    Route::post('/', [RestaurantController::class, 'store'])->middleware(['custom-auth']);
    Route::get('/{id}', 'App\Http\Controllers\RestaurantController@show');
    Route::patch('/{id}', [RestaurantController::class, 'update'])->middleware(['custom-auth']);
    Route::delete('/{id}', [RestaurantController::class, 'destroy'])->middleware(['custom-auth']);
});

//Users

Route::prefix('users')->group(function () {
    Route::get('/', 'App\Http\Controllers\UserController@index'); 
    Route::get('/{id}', 'App\Http\Controllers\UserController@show'); 
    Route::post('/login', 'App\Http\Controllers\UserController@login');
    Route::post('/', 'App\Http\Controllers\UserController@store'); 
    Route::patch('/{id}', 'App\Http\Controllers\UserController@update'); 
    Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy'); 
});
