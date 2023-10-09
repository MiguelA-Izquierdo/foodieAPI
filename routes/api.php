<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Restaurants
Route::prefix('restaurants')->group(function () {
    Route::get('/', 'App\Http\Controllers\RestaurantController@index');
    Route::post('/', 'App\Http\Controllers\RestaurantController@store');
    Route::get('/{id}', 'App\Http\Controllers\RestaurantController@show');
    Route::patch('/{id}', 'App\Http\Controllers\RestaurantController@update');
    Route::delete('/{id}', 'App\Http\Controllers\RestaurantController@destroy');
});

//Users

Route::prefix('users')->group(function () {
    Route::get('/', 'App\Http\Controllers\UserController@index'); // Endpoint para obtener todos los usuarios
    Route::get('/{id}', 'App\Http\Controllers\UserController@show'); // Endpoint para obtener un usuario por ID
    Route::post('/', 'App\Http\Controllers\UserController@store'); // Endpoint para crear un nuevo usuario
    Route::patch('/{id}', 'App\Http\Controllers\UserController@update'); // Endpoint para actualizar un usuario
    Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy'); // Endpoint para eliminar un usuario
});
