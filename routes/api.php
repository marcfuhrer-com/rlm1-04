<?php

use App\Http\Controllers\PublisherDataController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\UserController;
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

// public routes
//Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/buildings', [BuildingController::class, 'index']);
    Route::get('/buildings/{id}/floors', [FloorController::class, 'show'])->where('id', '[0-9]+');
    Route::post('/views', [PublisherDataController::class, 'store']);
    Route::get('/logout', [UserController::class, 'logout']);
});

