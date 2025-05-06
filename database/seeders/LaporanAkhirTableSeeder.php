<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use App\Models\LaporanAkhir;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LaporanAkhirTableSeeder extends Seeder
{
    public function run(): void
    {
        $kelompoks = Kelompok::all();

        foreach ($kelompoks as $kelompok) {
            $tanggalUpload = Carbon::create(2024, 11, rand(13, 16))
                ->setHour(rand(8, 17))
                ->setMinute(rand(0, 59))
                ->setSecond(rand(0, 59));

            LaporanAkhir::create([
                'kelompok_id' => $kelompok->id,
                'file_laporan_akhir' => 'kelompok_' . $kelompok->id . '.pdf',
                'tanggal_upload' => $tanggalUpload,
                'created_at' => $tanggalUpload,
                'updated_at' => $tanggalUpload,
            ]);
        }
    }
}
