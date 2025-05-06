<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pembimbing;
use App\Models\Siswa;
use App\Models\LaporanAkhir;
use App\Models\Penilaian;
use Carbon\Carbon;

class PembimbingController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->user()->id;
        $pembimbingId = Pembimbing::where('user_id', $userId)->value('id');

        $tanggalHariIni = Carbon::today();

        $jumlahSiswa = Siswa::whereHas('anggotaKelompok.kelompok.pembimbingKelompok', function ($query) use ($pembimbingId) {
            $query->where('pembimbing_id', $pembimbingId);
        })->count();

        $jumlahAbsensi = Absensi::where('pembimbing_id', $pembimbingId)->count();

        $jumlahPenilaian = Penilaian::where('pembimbing_id', $pembimbingId)->count();

        $jumlahLaporan = LaporanAkhir::whereHas('kelompok.pembimbingKelompok', function ($query) use ($pembimbingId) {
            $query->where('pembimbing_id', $pembimbingId);
        })->count();

        $siswaList = Siswa::whereHas('anggotaKelompok.kelompok.pembimbingKelompok', function ($query) use ($pembimbingId) {
            $query->where('pembimbing_id', $pembimbingId);
        })->get();
        
        $recentActivity = $siswaList->map(function ($siswa) use ($tanggalHariIni) {
            $absenHariIni = Absensi::where('siswa_id', $siswa->id)
                ->whereDate('tanggal', $tanggalHariIni)
                ->first();
    
            return [
                'nama' => $siswa->nama_siswa,
                'status' => $absenHariIni ? 'Sudah Absen' : 'Belum Absen',
            ];
        });

        $notYet = Absensi::where('pembimbing_id', $pembimbingId)
            ->doesntHave('catatanPembimbing')
            ->count();

        $monitored = Absensi::where('pembimbing_id', $pembimbingId)
            ->whereHas('catatanPembimbing', function($query) {
                $query->where('catatan', '!=', '');
            })
            ->count();

        return view(
            'pembimbing.dashboard', 
            ['title' => 'Dashboard Pembimbing'],
            compact('jumlahSiswa', 'jumlahAbsensi', 'jumlahPenilaian', 'jumlahLaporan', 'recentActivity', 'notYet', 'monitored')
        );
    }
}