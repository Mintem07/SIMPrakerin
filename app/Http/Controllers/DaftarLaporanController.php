<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use App\Models\LaporanAkhir;

class DaftarLaporanController extends Controller
{
    public function laporanPrakerin()
    {
        $userId = auth()->user()->id;
        $pembimbingId = Pembimbing::where('user_id', $userId)->value('id');
        
        $laporanAkhir = LaporanAkhir::with(['kelompok.pembimbingKelompok'])
            ->whereHas('kelompok.pembimbingKelompok', function($query) use ($pembimbingId) {
                $query->where('pembimbing_id', $pembimbingId);
            })
            ->get();

        return view('pembimbing.laporan-prakerin', [
            'title' => 'Laporan Akhir',
            'laporan' => $laporanAkhir
        ]);
    }

}
