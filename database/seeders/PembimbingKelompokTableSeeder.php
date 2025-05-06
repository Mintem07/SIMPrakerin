<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembimbingKelompokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kelompok dan pembimbing yang ada
        $kelompoks = DB::table('kelompoks')->pluck('id')->toArray();
        $pembimbings = DB::table('pembimbings')->pluck('id')->toArray();

        if (empty($kelompoks)) {
            $this->command->error('Tidak ada data kelompok!');
            return;
        }

        if (empty($pembimbings)) {
            $this->command->error('Tidak ada data pembimbing!');
            return;
        }

        // Data yang akan diisi
        $pembimbingKelompokData = [];

        // Acak urutan kelompok dan pembimbing
        shuffle($kelompoks);
        shuffle($pembimbings);

        // Hitung berapa kelompok per pembimbing (maks 2)
        $kelompokPerPembimbing = 2;
        $totalPembimbing = count($pembimbings);
        $totalKelompok = count($kelompoks);

        // Distribusi kelompok ke pembimbing
        $pembimbingGroups = array_fill_keys($pembimbings, 0);

        foreach ($kelompoks as $kelompokId) {
            // Cari pembimbing yang masih memiliki kuota
            foreach ($pembimbingGroups as $pembimbingId => $count) {
                if ($count < $kelompokPerPembimbing) {
                    // Tambahkan data
                    $pembimbingKelompokData[] = [
                        'pembimbing_id' => $pembimbingId,
                        'kelompok_id' => $kelompokId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    
                    // Tambah count pembimbing
                    $pembimbingGroups[$pembimbingId]++;
                    break;
                }
            }
        }

        // Insert data ke database
        DB::table('pembimbing_kelompoks')->insert($pembimbingKelompokData);

        $this->command->info('Seeder PembimbingKelompok berhasil dijalankan!');
        $this->command->info("Total kelompok: $totalKelompok");
        $this->command->info("Total pembimbing: $totalPembimbing");
        $this->command->info('Distribusi pembimbing:');
        
        foreach ($pembimbingGroups as $pembimbingId => $count) {
            $this->command->info("Pembimbing $pembimbingId: $count kelompok");
        }
    }
}