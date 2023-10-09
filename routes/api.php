<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

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
Route::get('restaurants', 'App\Http\Controllers\RestaurantController@index');
Route::post('restaurants', 'App\Http\Controllers\RestaurantController@store');
Route::get('/restaurants/{id}', 'App\Http\Controllers\RestaurantController@show');
Route::patch('restaurants/{id}', 'App\Http\Controllers\RestaurantController@update');
Route::delete('restaurants/{id}', 'App\Http\Controllers\RestaurantController@destroy');
