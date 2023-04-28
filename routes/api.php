<?php

use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;

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
    Route::post('/check-token', [AuthController::class, 'checkToken']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/types', TypeController::class);

    Route::apiResource('/restaurants', RestaurantController::class);
    Route::post('/restaurants/uploadImage/{restaurant}', [RestaurantController::class,'uploadImage']);
    Route::post('/restaurants/note/',[RestaurantController::class, 'addNote']);
    Route::get('/restaurants/note/{restaurant}',[RestaurantController::class, 'getNote']);

    Route::apiResource('/preferences', PreferenceController::class);

    Route::get('/user/random', [UserController::class, 'randomRestaurant']);
    Route::get('/user/restaurants', [UserController::class, 'userRestaurant']);

});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

