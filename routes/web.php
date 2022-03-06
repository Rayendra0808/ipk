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
Route::get('/nasional', 'PageController@nasional')->name('nasional.index');
Route::get('/provinsi/{provinsi_id}', 'PageController@provinsi')->name('provinsi.index');
Route::get('/chart/area-nasional/{year}/province-id/{province_id}', 'ChartController@getDimension')->name('chart.getDimension');
Route::get('/chart/area-nasional/{year}/province-id/{province_id}/total', 'ChartController@getDimensionTotalProvince')->name('chart.getDimensionTotalProvince');
Route::get('/chart/dimension-province', 'ChartController@getDimensionProvince')->name('chart.getDimensionProvince');
Route::get('/chart/dimension-province-target', 'ChartController@getDimensionProvinceTarget')->name('chart.getDimensionProvinceTarget');
Route::get('/chart/indicator-province', 'ChartController@getIndicatorProvince')->name('chart.getIndicatorProvince');