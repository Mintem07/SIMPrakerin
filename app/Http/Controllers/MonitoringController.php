<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use App\Models\CatatanPembimbing;

class MonitoringController extends Controller
{
    public function monitoring()
    {
        $userId = auth()->user()->id;
        $pembimbingId = Pembimbing::where('user_id', $userId)->value('id');
        $notYet = Absensi::where('pembimbing_id', $pembimbingId)
        ->doesntHave('catatanPembimbing')
        ->get();

        $monitoring = Absensi::where('pembimbing_id', $pembimbingId)
        ->whereHas('catatanPembimbing', function($query) {
            $query->where('catatan', '!=', '');
        })
        ->get();

        return view('pembimbing.monitoring', [
            'title' => 'Monitoring Siswa',
            'notYet' => $notYet,
            'monitoring' => $monitoring,
        ]);
    }

    public function addCatatan(Request $request)
    {
        $request->validate([
            'absensi_id' => 'required|exists:absensis,id',
            'catatan' => 'required|string'
        ]);
        
        CatatanPembimbing::create([
            'absensi_id' => $request->absensi_id,
            'catatan' => $request->catatan,
        ]);
        
        return redirect()->back()->with('success', 'Catatan berhasil disimpan');
    }
}
