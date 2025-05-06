<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function absensi()
    {
        $siswa = Siswa::where('userId', auth()->user()->id)->first();
        if (!$siswa) {
            return view(
            'siswa.absensi',
            ['title' => 'Absensi Siswa']
            );
        }

        $absensi = DB::table('absensis')
            ->where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $kelompok = $siswa && $siswa->anggotaKelompok ? $siswa->anggotaKelompok->kelompok : null;
        if (!$kelompok) {
            return view(
            'siswa.absensi',
            ['title' => 'Absensi Siswa']
            );
        }

        $pembimbing = $kelompok->pembimbingKelompok ? $kelompok->pembimbingKelompok->pembimbing : null;
        if (!$pembimbing) {
            return view(
            'siswa.absensi',
            ['title' => 'Absensi Siswa']
            );
        }

        $siswaId = $siswa->id ?? null;
        $kelompokId = $kelompok->id ?? null;
        $pembimbingId = $pembimbing->id ?? null;

        if (is_null($siswaId) || is_null($kelompokId) || is_null($pembimbingId)) {
            return view(
            'siswa.absensi',
            ['title' => 'Absensi Siswa']
            );
        }

        // Debugging siswa and kelompok
        // dd($siswa, $kelompok, $pembimbing);

        if ($siswaId !== null && $kelompokId !== null && $pembimbingId !== null) {
            return view(
            'siswa.absensi',
            ['title' => 'Absensi Siswa'],
            compact('siswaId', 'kelompokId', 'pembimbingId', 'absensi')
            );
        }
    }

    public function addAbsensi(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'idSiswa' => 'required|integer|exists:users,id',
            'idKelompok' => 'required|integer|exists:kelompoks,id',
            'idPembimbing' => 'required|integer|exists:pembimbings,id',
            'keterangan' => 'required|string|in:Hadir,Izin,Sakit',
            'kegiatan' => 'required|string|max:500',
            'buktiAbsensi' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            if ($request->file('buktiAbsensi')->getSize() > 2048 * 1024) { // 2048 KB * 1024 = bytes
                return redirect()->back()->with('error', 'Ukuran gambar tidak boleh lebih dari 2 MB');
            }

            // Cek apakah siswa sudah absen hari ini
            $existingAbsensi = DB::table('absensis')
                ->where('siswa_id', $validatedData['idSiswa'])
                ->whereDate('tanggal', now()->format('Y-m-d'))
                ->first();

            if ($existingAbsensi) {
                return redirect()->back()->with('error', 'Anda sudah melakukan absensi hari ini.');
            }
            
            // Upload file
            $file = $request->file('buktiAbsensi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('absensi', $fileName, 'public');

            // dd($filePath);

            // Simpan data absensi
            DB::table('absensis')->insert([
                'siswa_id' => $validatedData['idSiswa'],
                'kelompok_id' => $validatedData['idKelompok'],
                'pembimbing_id' => $validatedData['idPembimbing'],
                'tanggal' => now()->format('Y-m-d'),
                'keterangan' => $validatedData['keterangan'],
                'kegiatan' => $validatedData['kegiatan'],
                'foto_kegiatan' => $filePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
