<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\CatatanPembimbing;
use App\Models\Penjadwalan;
use App\Models\Penilaian;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $siswa = Siswa::where('userId', auth()->user()->id)->first();
        $jadwal = Penjadwalan::All();

        $kelompok = $siswa && $siswa->anggotaKelompok ? $siswa->anggotaKelompok->kelompok : null;
        if (!$kelompok) {
            return view(
                'siswa.dashboard', 
                ['title' => 'Dashboard Siswa'],
                compact('jadwal')
            );
        }

        $pembimbing = $kelompok->pembimbingKelompok ? $kelompok->pembimbingKelompok->pembimbing : null;
        if (!$pembimbing) {
            return view(
                'siswa.dashboard', 
                ['title' => 'Dashboard Siswa'],
                compact('jadwal')
            );
        }

        $newNote = CatatanPembimbing::whereHas('absensi', function($query) use ($siswa) {
            $query->where('siswa_id', $siswa->id);
        })
        ->latest()
        ->take(2)
        ->get();

        $status = Penilaian::where('siswa_id', $siswa->id)->first();

        if (!$newNote) {
            return view(
                'siswa.dashboard', 
                ['title' => 'Dashboard Siswa'],
                compact('jadwal')
            );
        }

        return view(
            'siswa.dashboard', 
            ['title' => 'Dashboard Siswa'],
            compact('newNote', 'pembimbing', 'jadwal', 'status')
        );
    }

    public function checkNewNotes()
    {
        // Dapatkan siswa yang login
        $siswa = Siswa::where('userId', Auth::id())->first();
        
        if (!$siswa) {
            return response()->json([
                'has_new_notes' => false,
                'count' => 0
            ]);
        }

        $newNotes = CatatanPembimbing::where('created_at', '>=', now()->subMinute())
            ->whereHas('absensi', function($query) use ($siswa) {
                $query->where('siswa_id', $siswa->id);
            })
            ->count();

        return response()->json([
            'has_new_notes' => $newNotes > 0,
            'count' => $newNotes
        ]);
    }
}