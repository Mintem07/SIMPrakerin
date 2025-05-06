<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelompok;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanAkhirController extends Controller
{
    public function laporanAkhir()
    {
        $siswa = Siswa::where('userId', auth()->user()->id)->first();
        if (!$siswa) {
            return view(
            'siswa.absensi',
            ['title' => 'Absensi Siswa']
            );
        }

        $kelompok = $siswa->anggotaKelompok ? $siswa->anggotaKelompok->kelompok : null;
        if (!$kelompok) {
            return view(
                'siswa.final-report',
                ['title' => 'Laporan Akhir Siswa']
            );
        }

        $pembimbing = $kelompok->pembimbingKelompok ? $kelompok->pembimbingKelompok->pembimbing : null;
        if (!$pembimbing) {
            return view(
                'siswa.final-report',
                ['title' => 'Laporan Akhir Siswa']
            );
        }

        $file = LaporanAkhir::where('kelompok_id', $kelompok->id)->first();
        $statusKelompok = $kelompok->status;
        // dd($statusKelompok);

        if ($statusKelompok === 'diterima') {
            return view(
                'siswa.final-report',
                ['title' => 'Laporan Akhir Siswa'],
                compact('kelompok', 'pembimbing', 'file')
            );
        } else {
            return view(
                'siswa.final-report',
                ['title' => 'Laporan Akhir Siswa']
            );
        }
    }

    public function uploadLaporanAkhir(Request $request)
    {
        // Validasi request
        $request->validate([
            'idKelompok' => 'required|exists:kelompoks,id',
            'finalReport' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            $idKelompok = $request->input('idKelompok');
            $kelompok = Kelompok::findOrFail($idKelompok);

            // Cek apakah sudah ada laporan sebelumnya
            if ($kelompok->laporanAkhir) {
                // Hapus file lama jika ada
                Storage::disk('public')->delete($kelompok->laporanAkhir->file_path);
            }

            // Handle file upload
            if ($request->hasFile('finalReport')) {
                $file = $request->file('finalReport');
                $filename = 'laporan_akhir_' . $kelompok->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('laporan_akhir', $filename, 'public');

                // Create or update
                LaporanAkhir::updateOrCreate(
                    ['kelompok_id' => $kelompok->id],
                    [
                        'file_laporan_akhir' => $path,
                        'tanggal_upload' => now()
                    ]
                );
            }

            return redirect()->back()->with('success', 'Laporan akhir berhasil diunggah!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunggah laporan: ' . $e->getMessage());
        }
    }
}
