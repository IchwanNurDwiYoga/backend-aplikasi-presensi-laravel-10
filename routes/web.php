<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminJabatanController;
use App\Http\Controllers\AdminPegawaiController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminPresensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('login');
    Route::post('/admin/create',[AdminController::class, 'store']);
    Route::get('/', function () {
        return redirect('/home');
    });
});

Route::middleware(['auth:admin'])->group(function () {


    //ADMIN LAYER
    Route::get('/home', [DashboardController::class, 'index']);

    //ADMIN-PEGAWAI
    Route::get('/admin/pegawai', [AdminPegawaiController::class, 'index']);
    Route::get('/admin/pegawai/create', [AdminPegawaiController::class, 'create']);
    Route::post('/admin/pegawai', [AdminPegawaiController::class, 'store']); //belum berfungsi
    Route::post('/admin/pegawai/edit', [AdminPegawaiController::class, 'edit']); //sama
    Route::put('/admin/pegawai/edit/{nip}', [AdminPegawaiController::class, 'update']); //sama
    Route::delete('/admin/pegawai/{nip}', [AdminPegawaiController::class, 'destroy']);

    //ADMIN-JABATAN
    Route::get('/admin/jabatan', [AdminJabatanController::class, 'index']);
    Route::get('/admin/jabatan/create', [AdminJabatanController::class, 'create']);
    Route::post('/admin/jabatan', [AdminJabatanController::class, 'store']);
    Route::post('/admin/jabatan/edit', [AdminJabatanController::class, 'edit']);
    Route::put('/admin/jabatan/{id}/update', [AdminJabatanController::class, 'update']);
    Route::delete('/admin/jabatan/delete/{id}', [AdminJabatanController::class, 'destroy']);

    //ADMIN-PRESENSI
    Route::get('/admin/presensi', [AdminPresensiController::class, 'index']);
    Route::get('/admin/presensi/create', [AdminPresensiController::class, 'store']);
    Route::post('/admin/persetujuan-izin',[AdminPresensiController::class, 'editIzin']);
    Route::put('/admin/persetujuan-izin/{nip}/update',[AdminPresensiController::class, 'updateIzin']);

    //ADMIN-PRESENSI-DETAIL
    Route::get('/admin/presensi/detail/{kode_presensi}',[AdminPresensiController::class, 'showPresensiDetail']);

    //ADMIN-LAPORAN-PRESENSI-BULANAN
    Route::get('/admin/presensi/cetak-laporan/', [AdminPresensiController::class, 'presensiBulanan']);

    //ADMIN-SETTING
    Route::get('/admin/settings', [SettingsController::class, 'index']);
    Route::post('/admin/settings', [SettingsController::class, 'store']);
    Route::post('/admin/settings/{id}', [SettingsController::class, 'update']);

    Route::get('/presensi/edit', [PresensiController::class, 'edit']);
    Route::post('/presensi/edit/{kode}/{nip}', [PresensiController::class, 'update']);

    //logout
    Route::get('/logout',[AuthController::class, 'logout']);
});
