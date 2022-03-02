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

Route::get('/', 'PageController@index')->name('home.index');
Route::get('/dimensi/{slug}', 'PageController@dimensi')->name('dimensi.index');
Route::get('/chart/area-nasional/{year}', 'ChartController@getAreaNasionalByYear')->name('getAreaNasionalByYear');
