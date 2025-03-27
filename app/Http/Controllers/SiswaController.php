<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Kelompok;
use App\Models\AnggotaKelompok;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function dashboard()
    {
        return view(
            'siswa.dashboard', 
            ['title' => 'Dashboard Siswa']
        );
    }

    public function lengkapiProfil()
    {
        $siswa = Siswa::where('userId', auth()->user()->id)->first();

        return view(
            'siswa.profil',
            [
                'title' => 'Profil Siswa'
            ],
            compact('siswa')
        );
    }

    public function viewPengajuan()
    {
        $user = Auth::user();
        $siswa = Siswa::where('userId', $user->id)->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $kelompok = $siswa->anggotaKelompok ? $siswa->anggotaKelompok->kelompok : null;

        $siswaList = Siswa::whereDoesntHave('anggotaKelompok')
            ->orWhereHas('anggotaKelompok.kelompok', function ($query) {
            $query->where('status', 'ditolak');
            })
            ->get();

        // dd($kelompok);

        return view(
            'siswa.pengajuan',
            [
                'title' => 'Profil Siswa'
            ],
            compact('kelompok', 'siswaList')
        );
    }

    public function absensi()
    {
        $siswa = Siswa::where('userId', auth()->user()->id)->first();
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

    public function laporanAkhir()
    {
        $siswa = Siswa::where('userId', auth()->user()->id)->first();
        $kelompok = $siswa->anggotaKelompok ? $siswa->anggotaKelompok->kelompok : null;

        // dd($kelompok);

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
        // dd($statusKelompok);

        if ($statusKelompok === 'diterima') {
            return view(
                'siswa.final-report',
                ['title' => 'Laporan Akhir Siswa'],
                compact('kelompok', 'pembimbing')
            );
        } else {
            return view(
                'siswa.final-report',
                ['title' => 'Laporan Akhir Siswa']
            );
        }
    }

    public function addSiswa(Request $request)
    {
        $validatedData = $request->validate([
            'userId' => 'required|integer|exists:users,id',
            'namaSiswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'jenisKelamin' => 'required|string',
            'telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $siswa = new Siswa();
        $siswa->userId = $validatedData['userId'];
        $siswa->nama_siswa = $validatedData['namaSiswa'];
        $siswa->kelas = $validatedData['kelas'];
        $siswa->jurusan = $validatedData['jurusan'];
        $siswa->jenis_kelamin = $validatedData['jenisKelamin'];
        $siswa->telp = $validatedData['telp'];
        $siswa->alamat = $validatedData['alamat'];
        $siswa->save();

        if ($siswa->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Profil Berhasil Disimpan!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan profil.');
        }
    }

    public function updateSiswa(Request $request, $id)
    {
        $validatedData = $request->validate([
            'userId' => 'required|integer|exists:users,id',
            'namaSiswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'jenisKelamin' => 'required|string',
            'telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $siswa = Siswa::find($id);
        $siswa->userId = $validatedData['userId'];
        $siswa->nama_siswa = $validatedData['namaSiswa'];
        $siswa->kelas = $validatedData['kelas'];
        $siswa->jurusan = $validatedData['jurusan'];
        $siswa->jenis_kelamin = $validatedData['jenisKelamin'];
        $siswa->telp = $validatedData['telp'];
        $siswa->alamat = $validatedData['alamat'];
        $siswa->save();

        if ($siswa->wasChanged()) {
            return redirect()->back()->with('success', 'Profil Berhasil Diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal Memperbarui Profil!');
        }
    }

    public function ajukanKelompok(Request $request)
    {
        // \Log::info('Data Request:', $request->all());
        // Validasi input
        $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'nama_industri' => 'required|string|max:255',
            'alamat' => 'required|string',
            'anggota' => 'required|array|min:2|max:4', // Pastikan anggota antara 2-4
            'anggota.*' => [
                'required',
                'integer',
                Rule::exists('siswas', 'id'), // Pastikan siswa yang dipilih ada di database
                // Pastikan siswa belum masuk kelompok lain
                Rule::unique('anggota_kelompoks', 'siswa_id')
            ],
        ]);

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Simpan data industri
            $industri = Industri::create([
                'nama_industri' => $request->nama_industri,
                'alamat' => $request->alamat,
            ]);

            // Simpan data kelompok
            $kelompok = Kelompok::create([
                'nama_kelompok' => $request->nama_kelompok,
                'industri_id' => $industri->id,
                'status' => 'pending', // Default status
            ]);

            // Simpan data anggota kelompok
            foreach ($request->anggota as $siswa_id) {
                AnggotaKelompok::create([
                    'kelompok_id' => $kelompok->id,
                    'siswa_id' => $siswa_id,
                ]);
            }

            // Commit transaksi jika semua berhasil
            DB::commit();

            return redirect()->back()->with('success', 'Kelompok berhasil diajukan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateAjukanKelompok(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'nama_industri' => 'required|string|max:255',
            'alamat' => 'required|string',
            'anggota' => 'required|array|min:2|max:4', // Pastikan anggota antara 2-4
            'anggota.*' => [
                'required',
                'integer',
                Rule::exists('siswas', 'id'), // Pastikan siswa yang dipilih ada di database
                Rule::unique('anggota_kelompoks', 'siswa_id')->ignore($id, 'kelompok_id') // Pastikan siswa belum masuk kelompok lain kecuali kelompok ini
            ],
        ]);

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Update data industri
            $kelompok = Kelompok::findOrFail($id);
            $industri = $kelompok->industri;
            $industri->update([
                'nama_industri' => $request->nama_industri,
                'alamat' => $request->alamat,
            ]);

            // Update data kelompok
            $kelompok->update([
                'nama_kelompok' => $request->nama_kelompok,
                'status' => 'pending',
            ]);

            // Hapus anggota kelompok lama
            AnggotaKelompok::where('kelompok_id', $kelompok->id)->delete();

            // Tambahkan anggota kelompok baru
            foreach ($request->anggota as $siswa_id) {
                AnggotaKelompok::create([
                    'kelompok_id' => $kelompok->id,
                    'siswa_id' => $siswa_id,
                ]);
            }

            // Commit transaksi jika semua berhasil
            DB::commit();

            return redirect()->back()->with('success', 'Kelompok berhasil diperbarui!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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