<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Pembimbing;
use Illuminate\Http\Request;

class DaftarNilaiController extends Controller
{
    public function nilai()
    {
        $userId = auth()->user()->id;
        $pembimbingId = Pembimbing::where('user_id', $userId)->value('id');
        
        $penilaian = Penilaian::with(['siswa'])
            ->where('pembimbing_id', $pembimbingId)
            ->get();

        return view('pembimbing.penilaian', [
            'title' => 'Penilaian Siswa',
            'penilaian' => $penilaian
        ]);
    }

    public function editNilai(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:penilaians,id',
            'avgPoin' => 'required|numeric|between:0,100',
            'reportPoin' => 'required|numeric|between:0,100',
        ]);

        $avgPoin = $request->avgPoin;
        $reportPoin = $request->reportPoin;

        $nilaiPrakerin = ($avgPoin * 0.8) + ($reportPoin * 0.2);

        if ($nilaiPrakerin >= 70.00) {
            $nilai = Penilaian::find($request->id);
            $nilai->update([
                'average_poin' => $request->avgPoin,
                'report_poin' => $request->reportPoin,
                'status' => 'Lulus',
            ]);

            return redirect()->back()->with('success', 'Nilai berhasil diupdate');
        }

        $nilai = Penilaian::find($request->id);
        $nilai->update([
            'average_poin' => $request->avgPoin,
            'report_poin' => $request->reportPoin,
            'status' => 'Tidak Lulus',
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil diupdate');
    }
}
