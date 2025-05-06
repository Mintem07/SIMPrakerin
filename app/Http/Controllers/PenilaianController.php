<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Berkas;
use App\Models\Penilaian;

class PenilaianController extends Controller
{
    public function viewPenilaian()
    {
        $siswa = Siswa::where('userId', auth()->user()->id)->first();
        if (!$siswa) {
            return view(
            'siswa.absensi',
            ['title' => 'Absensi Siswa']
            );
        }
        
        $kelompok = $siswa->anggotaKelompok ? $siswa->anggotaKelompok->kelompok : null;
        $berkas = Berkas::All();
        $bukti = Penilaian::where('siswa_id', $siswa->id)->first();

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

        $statusKelompok = $kelompok->status;

        if ($statusKelompok === 'diterima') {
            return view(
                'siswa.penilaian',
                ['title' => 'Penilaian'],
                compact('siswa', 'kelompok', 'pembimbing', 'berkas', 'bukti')
            );
        } else {
            return view(
                'siswa.penilaian',
                ['title' => 'Penilaian']
            );
        }
        
    }

    public function uploadBuktiNilai(Request $request)
    {
        $request->validate([
            'idSiswa' => 'required|exists:siswas,id',
            'idKelompok' => 'required|exists:kelompoks,id',
            'idPembimbing' => 'required|exists:pembimbings,id',
            'finalReport' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // dd($request);

        try {
            // Simpan file
            $file = $request->file('finalReport');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('bukti_nilai', $fileName, 'public');
    
            // Simpan ke database
            $penilaian = Penilaian::updateOrCreate(
                ['siswa_id' => $request->idSiswa],
                [
                    'kelompok_id' => $request->idKelompok,
                    'pembimbing_id' => $request->idPembimbing,
                    'form_bukti' => $filePath
                ]
            );
    
            return redirect()->back()->with('success', 'Bukti nilai berhasil diunggah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunggah bukti nilai: ' . $e->getMessage());
        }
    }

    public function downloadBerkas($id)
    {
        $berkas = Berkas::findOrFail($id);
        $filePath = public_path('storage/'.$berkas->file_berkas);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan di: '.$filePath);
        }

        $extension = pathinfo($berkas->file_berkas, PATHINFO_EXTENSION);
        $downloadName = $berkas->nama_berkas.'.'.$extension;
        
        return response()->download($filePath, $downloadName);
    }
}
