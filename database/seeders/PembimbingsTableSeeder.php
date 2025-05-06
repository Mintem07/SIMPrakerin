<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembimbingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pembimbing = [
            [
                'user_id' => 33,
                'nama_pembimbing' => 'Drs. M. Setyo Nurhuda, S. Pd',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '085234100781',
                'created_at' => now()
            ],
            [
                'user_id' => 34,
                'nama_pembimbing' => 'Adi Endriawan, S. Kom',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '0895397356602',
                'created_at' => now()
            ],
            [
                'user_id' => 35,
                'nama_pembimbing' => 'Billah Muhammad, S. Kom',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '089528387509',
                'created_at' => now()
            ],
            [
                'user_id' => 36,
                'nama_pembimbing' => 'Maria Ulfatun Khasanah, S. Pd',
                'jenis_kelamin' => 'Perempuan',
                'telp' => '081776479002',
                'created_at' => now()
            ],
            [
                'user_id' => 37,
                'nama_pembimbing' => 'Ainul Hidayah, S. Kom',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '081554435883',
                'created_at' => now()
            ],
        ];

        DB::table('pembimbings')->insert($pembimbing);
    }
}
