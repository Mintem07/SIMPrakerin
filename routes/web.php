<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LaporanAkhirController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\UbahPasswordController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DaftarLaporanController;
use App\Http\Controllers\DaftarNilaiController;

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

        Route::get('/profil', [ProfilController::class, 'lengkapiProfil'])->name('siswa.profil');
        Route::post('/add-profil', [ProfilController::class, 'addSiswa'])->name('siswa.add-profil');
        Route::post('/update-profil/{id}', [ProfilController::class, 'updateSiswa'])->name('siswa.update-profil');

        Route::get('/pengajuan-kelompok', [PengajuanController::class, 'viewPengajuan'])->name('siswa.pengajuan');
        Route::post('/add-pengajuan-kelompok', [PengajuanController::class, 'ajukanKelompok'])->name('siswa.simpan-pengajuan');
        Route::post('/update-pengajuan-kelompok/{id}', [PengajuanController::class, 'updateAjukanKelompok'])->name('siswa.edit-pengajuan');

        Route::get('/absensi', [AbsensiController::class, 'absensi'])->name('siswa.absensi');
        Route::post('/add-absensi', [AbsensiController::class, 'addAbsensi'])->name('siswa.add-absensi');
        
        Route::get('/laporan-akhir', [LaporanAkhirController::class, 'laporanAkhir'])->name('siswa.final-report');
        Route::post('/upload-laporan-akhir', [LaporanAkhirController::class, 'uploadLaporanAkhir'])->name('siswa.upload-laporan-akhir');
        
        Route::get('/penilaian', [PenilaianController::class, 'viewPenilaian'])->name('siswa.penilaian');
        Route::post('/upload-bukti', [PenilaianController::class, 'uploadBuktiNilai'])->name('siswa.upload-bukti');
        Route::get('/download/{id}', [PenilaianController::class, 'downloadBerkas'])->name('berkas.download');

        Route::get('/setting', [UbahPasswordController::class, 'showSetting'])->name('siswa.setting');
        Route::post('/setting', [UbahPasswordController::class, 'ubahPassword'])->name('setting.update');
    });

    Route::get('/check-new-notes', [SiswaController::class, 'checkNewNotes']);
});

Route::middleware(['auth', 'pembimbing'])->group(function () {
    Route::prefix('pembimbing')->group(function () {
        Route::get('/', [PembimbingController::class, 'dashboard'])->name('pembimbing.dashboard');

        Route::get('/monitoring-siswa', [MonitoringController::class, 'monitoring'])->name('pembimbing.monitoring');
        Route::post('/add-catatan', [MonitoringController::class, 'addCatatan'])->name('pembimbing.add-catatan');

        Route::get('/laporan-prakerin', [DaftarLaporanController::class, 'laporanPrakerin'])->name('pembimbing.laporan-prakerin');

        Route::get('/penilaian-siswa', [DaftarNilaiController::class, 'nilai'])->name('pembimbing.nilai');
        Route::post('/edit-nilai', [DaftarNilaiController::class, 'editNilai'])->name('pembimbing.edit-nilai');
    });
});

// Route::get('/tes-pdf', function () {
//     return view('filament.resources.kelompok.pdf.surat-pengajuan-pkl');
// });

Route::get('/anda-tidak-memiliki-akses', function () {
    return view('errors.hak-akses');
});

Route::fallback(function () {
    return view('errors.404');
});