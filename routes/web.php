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


Route::get('/slideshow/roomManagement', function () {
    return \App\Http\Controllers\PublisherDataController::getView("room-management");
});
Route::get('/slideshow/mensaRolex', function () {
    return \App\Http\Controllers\PublisherDataController::getView("mensa-rolex");
});
Route::get('/slideshow/indoorLocalization', function () {
    return \App\Http\Controllers\PublisherDataController::getView("indoor-localization");
});
Route::get('/usage', function () {
    if(!Auth::user()) {
        return view('welcome');
    } else
    {
        return \App\Http\Controllers\PublisherDataController::getUsageView(Auth::user()->id);
    }
});

Route::get('/welcome', function () {
    return redirect('/log-viewer');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
