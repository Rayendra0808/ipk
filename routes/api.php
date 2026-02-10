<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Referensi
Route::get('referensi/tahun', 'Api\ReferensiController@tahun');
Route::get('referensi/provinsi', 'Api\ReferensiController@provinsi');
Route::get('referensi/dimensi', 'Api\ReferensiController@dimensi');
Route::get('referensi/indikator', 'Api\ReferensiController@indikator');

// Proyeksi
Route::get('proyeksi/dimensi-nasional', 'Api\ProyeksiController@dimensiNasional');
Route::get('proyeksi/dimensi-provinsi', 'Api\ProyeksiController@dimensiProvinsi');
Route::get('proyeksi/indikator-nasional', 'Api\ProyeksiController@indikatorNasional');
Route::get('proyeksi/indikator-provinsi', 'Api\ProyeksiController@indikatorProvinsi');

// Data
Route::get('data/dimensi-nasional', 'Api\DataController@dimensiNasional');
Route::get('data/dimensi-provinsi', 'Api\DataController@dimensiProvinsi');
Route::get('data/indikator-nasional', 'Api\DataController@indikatorNasional');
Route::get('data/indikator-provinsi', 'Api\DataController@indikatorProvinsi');

// Dokumen
Route::get('dokumen/buku', 'Api\DokumenController@buku');
Route::get('dokumen/regulasi', 'Api\DokumenController@regulasi');
Route::get('dokumen/hasil-perhitungan-nasional', 'Api\DokumenController@hasilPerhitunganNasional');
Route::get('dokumen/hasil-perhitungan-provinsi', 'Api\DokumenController@hasilPerhitunganProvinsi');
Route::get('dokumen/metadata-indikator', 'Api\DokumenController@metadataIndikator');