<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

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
        $userId = auth()->user()->id;
        $pembimbingId = \App\Models\Pembimbing::where('user_id', $userId)->value('id');
        // dd($pembimbingId);
        $absensiData = Absensi::where('pembimbing_id', $pembimbingId)->get();

        if ($absensiData->isNotEmpty()) {
            return view(
            'pembimbing.monitoring',
            ['title' => 'Monitoring Siswa'],
            compact('absensiData')
            );
        } else {
            return view(
            'pembimbing.monitoring',
            ['title' => 'Monitoring Siswa']
            );
        }
    }

    public function nilai()
    {
        return view(
            'pembimbing.penilaian',
            ['title' => 'Penilaian Siswa']
        );
    }
}
