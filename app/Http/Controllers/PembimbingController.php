<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    //
    public function dashboard()
    {
        return view(
            'pembimbing.dashboard', 
            ['title' => 'Dashboard Pembimbing']
        );
    }

    public function daftarPengajuan()
    {
        return view(
            'pembimbing.daftar-pengajuan',
            ['title' => 'Daftar Pengajuan']
        );
    }

    public function monitoring()
    {
        return view(
            'pembimbing.monitoring',
            ['title' => 'Monitoring Siswa']
        );
    }

    public function nilai()
    {
        return view(
            'pembimbing.penilaian',
            ['title' => 'Penilaian Siswa']
        );
    }
}
