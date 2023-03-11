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
//    Route::get('/test', [TestController::class,'test']);
//    Route::post('/logout', [AuthController::class, 'logout']);
//
//    Route::post('/typerestaurant/store', [TypeRestaurantController::class,'store']);
//    Route::post('/typerestaurant/update', [TypeRestaurantController::class,'update']);
//    Route::get('/typerestaurant/get', [TypeRestaurantController::class,'get']);
//    Route::delete('/typerestaurant/delete', [TypeRestaurantController::class,'delete']);

    Route::apiResource('/restaurants', RestaurantController::class);
});
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);

