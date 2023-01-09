<?php

use App\Http\Controllers\PublisherDataController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\ApiLoginController;
use Illuminate\Http\Request;
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


Route::group(['middleware' => ['accept-header', 'headers']], function () {
    // public routes
    Route::post('/v1/login', [ApiLoginController::class, 'login'])->middleware(['content-header', 'throttle:10,1']);


    // protected routes
    Route::group(['middleware' => ['auth:sanctum', 'throttle:60,1']], function () {
        Route::get('/v1/buildings', [BuildingController::class, 'index']);
        Route::get('/v1/buildings/{id}/floors', [FloorController::class, 'show'])->where('id', '[0-9]+');
        Route::put('/v1/views', [PublisherDataController::class, 'store'])->middleware('content-header');
    });
});

