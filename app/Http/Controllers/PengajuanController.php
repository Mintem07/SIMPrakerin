<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use App\Models\AnggotaKelompok;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PengajuanController extends Controller
{
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

    public function ajukanKelompok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelompok' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $exists = Kelompok::whereRaw('LOWER(nama_kelompok) = ?', [strtolower($value)])
                        ->exists();
                    if ($exists) {
                        $fail('Nama kelompok sudah digunakan, silakan pilih nama lain.');
                    }
                }
            ],
            'nama_industri' => 'required|string|max:255',
            'pimpinan' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'alamat' => 'required|string',
            'anggota' => [
                'required',
                'array',
                'min:2',
                'max:4',
                function ($attribute, $value, $fail) {
                    // Validasi duplikat anggota dalam input yang sama
                    if (count($value) !== count(array_unique($value))) {
                        $fail('Terdapat anggota yang duplikat dalam kelompok.');
                    }
                }
            ],
            'anggota.*' => [
                'required',
                'integer',
                Rule::exists('siswas', 'id'), // Pastikan siswa yang dipilih ada di database
                Rule::unique('anggota_kelompoks', 'siswa_id')
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Nama kelompok sudah digunakan atau terdapat duplikasi anggota');
        }

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Cek apakah industri dengan nama yang sama sudah ada
            $industri = Industri::whereRaw('LOWER(nama_industri) = ?', [strtolower($request->nama_industri)])
                ->first();
            
            // Jika industri belum ada, buat baru
            if (!$industri) {
                $industri = Industri::create([
                    'nama_industri' => $request->nama_industri,
                    'pimpinan' => $request->pimpinan,
                    'bidang' => $request->bidang,
                    'alamat' => $request->alamat,
                ]);
            }

            // Simpan data kelompok
            $kelompok = Kelompok::create([
                'nama_kelompok' => $request->nama_kelompok,
                'industri_id' => $industri->id,
                'status' => 'pending',
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
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateAjukanKelompok(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelompok' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($id) {
                    $exists = Kelompok::whereRaw('LOWER(nama_kelompok) = ?', [strtolower($value)])
                        ->where('id', '!=', $id)
                        ->exists();
                    if ($exists) {
                        $fail('Nama kelompok sudah digunakan, silakan pilih nama lain.');
                    }
                }
            ],
            'nama_industri' => 'required|string|max:255',
            'pimpinan' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'alamat' => 'required|string',
            'anggota' => [
                'required',
                'array',
                'min:2',
                'max:4',
                function ($attribute, $value, $fail) {
                    if (count($value) !== count(array_unique($value))) {
                        $fail('Terdapat anggota yang duplikat dalam kelompok.');
                    }
                }
            ],
            'anggota.*' => [
                'required',
                'integer',
                Rule::exists('siswas', 'id'), // Pastikan siswa yang dipilih ada di database
                Rule::unique('anggota_kelompoks', 'siswa_id')->ignore($id, 'kelompok_id') // Pastikan siswa belum masuk kelompok lain kecuali kelompok ini
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Nama kelompok sudah digunakan atau terdapat duplikasi anggota');
        }

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Update data industri
            $kelompok = Kelompok::findOrFail($id);
            $industriLama = $kelompok->industri;

            // Cek apakah industri dengan nama yang sama sudah ada (selain industri lama)
            $industriBaru = Industri::whereRaw('LOWER(nama_industri) = ?', [strtolower($request->nama_industri)])
                ->where('id', '!=', $industriLama->id)
                ->first();

            // Jika ada industri dengan nama yang sama, gunakan yang sudah ada
            if ($industriBaru) {
                $industri = $industriBaru;
                
                // Update data kelompok dengan industri yang baru
                $kelompok->update([
                    'nama_kelompok' => $request->nama_kelompok,
                    'industri_id' => $industri->id,
                    'status' => 'pending',
                ]);

                // Hapus industri lama jika tidak digunakan oleh kelompok lain
                if ($industriLama->kelompok()->count() === 0) {
                    $industriLama->delete();
                }
            } else {
                // Update data industri yang lama
                $industriLama->update([
                    'nama_industri' => $request->nama_industri,
                    'pimpinan' => $request->pimpinan,
                    'bidang' => $request->bidang,
                    'alamat' => $request->alamat,
                ]);

                // Update data kelompok
                $kelompok->update([
                    'nama_kelompok' => $request->nama_kelompok,
                    'status' => 'pending',
                ]);
            }

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
}
