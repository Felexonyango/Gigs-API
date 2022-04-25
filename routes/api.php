<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);

//protected routes

Route::group(['middleware'=>['auth:sanctum']],function () {
    Route::post('/create',[ListingController::class, "create"]);
    Route::put('/{id}', [ListingController::class, "update"]);
    Route::delete('/{id}', [ListingController::class, "destroy"]);
});

//public routes
    Route::get('/',  [ListingController::class, "index"]);
    Route::get('/{id}', [ListingController::class, "show"]);

   




