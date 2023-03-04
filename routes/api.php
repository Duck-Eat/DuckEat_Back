<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TypeRestaurantController;
use App\Http\Controllers\RestaurantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/test', [TestController::class,'test']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/typerestaurant/store', [TypeRestaurantController::class,'store']);
    Route::post('/typerestaurant/update', [TypeRestaurantController::class,'update']);
    Route::get('/typerestaurant/get', [TypeRestaurantController::class,'get']);
    Route::delete('/typerestaurant/delete', [TypeRestaurantController::class,'delete']);

    Route::post('/restaurant/store', [RestaurantController::class,'store']);
    Route::post('/restaurant/update', [RestaurantController::class,'update']);
    Route::get('/restaurant/get', [RestaurantController::class,'get']);
    Route::delete('/restaurant/delete', [RestaurantController::class,'delete']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::post('/restaurant/store', [RestaurantController::class,'store']);
