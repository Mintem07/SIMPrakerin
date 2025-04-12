<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Pembimbing;
use App\Models\CatatanPembimbing;
use App\Models\LaporanAkhir;
use App\Models\Penilaian;

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
        $validated = $request->validate([
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

    public function addCatatan(Request $request)
    {
        $validated = $request->validate([
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