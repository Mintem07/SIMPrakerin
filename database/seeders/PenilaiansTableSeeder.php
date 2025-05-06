<?php

namespace Database\Seeders;

use App\Models\Penilaian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaiansTableSeeder extends Seeder
{
    public function run(): void
    {
        $siswaIdsBuruk = [9, 21, 31];

        $siswaWithDetails = DB::table('siswas')
            ->join('anggota_kelompoks', 'siswas.id', '=', 'anggota_kelompoks.siswa_id')
            ->join('kelompoks', 'anggota_kelompoks.kelompok_id', '=', 'kelompoks.id')
            ->join('pembimbing_kelompoks', 'kelompoks.id', '=', 'pembimbing_kelompoks.kelompok_id')
            ->select(
                'siswas.id as siswa_id',
                'kelompoks.id as kelompok_id',
                'pembimbing_kelompoks.pembimbing_id as pembimbing_id'
            )
            ->get();

        // Simpan base poin per kelompok
        $kelompokBasePoints = [];

        foreach ($siswaWithDetails as $data) {
            $siswaId = $data->siswa_id;
            $kelompokId = $data->kelompok_id;
            $pembimbingId = $data->pembimbing_id;

            // Buat base poin kelompok hanya sekali
            if (!isset($kelompokBasePoints[$kelompokId])) {
                $kelompokBasePoints[$kelompokId] = fake()->randomFloat(2, 75, 90);
            }

            $basePoin = $kelompokBasePoints[$kelompokId];

            if (in_array($siswaId, $siswaIdsBuruk)) {
                $averagePoin = fake()->randomFloat(2, 50, 65);
                $reportPoin = fake()->randomFloat(2, 50, 70);
            } else {
                // Pastikan nilai akhir > 70
                $averagePoin = fake()->randomFloat(2, 70, 90);
                $reportPoin = fake()->randomFloat(2, 70, 95);
            }

            $nilaiAkhir = round(($averagePoin * 0.8) + ($reportPoin * 0.2), 2);
            $status = $nilaiAkhir < 70 ? 'Tidak Lulus' : 'Lulus';

            Penilaian::create([
                'siswa_id' => $siswaId,
                'kelompok_id' => $kelompokId,
                'pembimbing_id' => $pembimbingId,
                'average_poin' => $averagePoin,
                'report_poin' => $reportPoin,
                'form_bukti' => 'form_penilaian_' . rand(1, 3) . '.pdf',
                'status' => $status,
            ]);
        }
    }
}
