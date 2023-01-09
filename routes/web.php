<?php

use App\Http\Controllers\SlideshowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/slideshow/roomManagement', [SlideshowController::class, 'roomManagement']);
//Route::get('/slideshow/roomManagement', \App\Http\Controllers\PublisherDataController::getView("room-management"));
//Route::get('/slideshow/mensaRolex', [SlideshowController::class, 'mensaRolex']);
//Route::get('/slideshow/indoorLocalization', [SlideshowController::class, 'indoorLocalization']);
Route::get('/slideshow/roomManagement', function () {
    return \App\Http\Controllers\PublisherDataController::getView("room-management");
});
Route::get('/slideshow/mensaRolex', function () {
    return \App\Http\Controllers\PublisherDataController::getView("mensaRolex");
});
Route::get('/slideshow/mensaRolex', function () {
    return \App\Http\Controllers\PublisherDataController::getView("mensaRolex");
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
