<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            SiswasTableSeeder::class,
            PembimbingsTableSeeder::class,
            IndustrisTableSeeder::class,
            KelompoksTableSeeder::class,
            PembimbingKelompokTableSeeder::class,
            AbsensisTableSeeder::class,
            CatatanTableSeeder::class,
            LaporanAkhirTableSeeder::class,
            PenilaiansTableSeeder::class,
        ]);
    }
}
