<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembimbingController;

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

Route::get('/', function () {
    return view(
        'auth.login',
        [
            'title' => 'Login',
        ]
    );
});

Auth::routes();

Route::middleware(['auth', 'siswa'])->group(function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');

        Route::get('/profil', [SiswaController::class, 'lengkapiProfil'])->name('siswa.profil');
        Route::post('/add-profil', [SiswaController::class, 'addSiswa'])->name('siswa.add-profil');
        Route::post('/update-profil/{id}', [SiswaController::class, 'updateSiswa'])->name('siswa.update-profil');

        Route::get('/pengajuan-kelompok', [SiswaController::class, 'viewPengajuan'])->name('siswa.pengajuan');
        Route::post('/add-pengajuan-kelompok', [SiswaController::class, 'ajukanKelompok'])->name('siswa.simpan-pengajuan');

        Route::get('/absensi-mingguan', [SiswaController::class, 'absensi'])->name('siswa.absensi');
        Route::post('/add-absensi-mingguan', [SiswaController::class, 'absensiMingguan'])->name('siswa.add-absensi');

        Route::get('/laporan-akhir', [SiswaController::class, 'laporanAkhir'])->name('siswa.final-report');

    });
});

Route::middleware(['auth', 'pembimbing'])->group(function () {
    Route::prefix('pembimbing')->group(function () {
        Route::get('/', [PembimbingController::class, 'dashboard'])->name('pembimbing.dashboard');
        Route::get('/monitoring-siswa', [PembimbingController::class, 'monitoring'])->name('pembimbing.monitoring');
        Route::get('/penilaian-siswa', [PembimbingController::class, 'nilai'])->name('pembimbing.nilai');
    });
});