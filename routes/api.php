<?php

use App\Http\Controllers\FaceController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiPresensiApiController;
use App\Http\Controllers\SettingApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//cari pegawai
Route::get('/pegawai/cari/{nip}',[PegawaiController::class, 'index']);

//presensi
Route::get('/pegawai/presensi',[PegawaiPresensiApiController::class, 'index']);
Route::put('/pegawai/presensi/masuk/{kode}',[PegawaiPresensiApiController::class, 'presensiMasuk']);
Route::put('/pegawai/presensi/pulang/{kode}',[PegawaiPresensiApiController::class, 'presensiPulang']);
Route::put('/pegawai/presensi/izin/{kode}',[PegawaiPresensiApiController::class, 'presensiIzin']);

Route::get('/pegawai/riwayat/{nip}',[PegawaiPresensiApiController::class, 'riwayat']);

Route::get('/setting',[SettingApiController::class, 'getSetting']);

Route::post('/face',[FaceController::class, 'store']);
Route::get('/face/get',[FaceController::class, 'index']);