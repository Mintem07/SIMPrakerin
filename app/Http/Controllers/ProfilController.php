<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
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
}
