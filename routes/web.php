<?php

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
    // return view('auth/login');
    if(Auth::check()) {
        return view('home');
    }
    return view('auth/login');
});

Route::prefix('horoscopes')->group(function () {
    Route::get('','App\Http\Controllers\HoroscopeController@index')->name('horoscope.index')->middleware("auth");
    Route::post('storeAjax', 'App\Http\Controllers\HoroscopeController@storeAjax')->name('horoscope.storeAjax')->middleware("auth");
    Route::post('delete/{horoscope}', 'App\Http\Controllers\HoroscopeController@destroy')->name('horoscope.destroy')->middleware("auth");
});
Route::prefix('calendors')->group(function () {
    Route::get('','App\Http\Controllers\HoroscopeScoreController@index')->name('calendor.index')->middleware("auth");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
