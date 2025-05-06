<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustrisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = [
            [
                'nama_industri' => 'PT. Lintas Data Prima',
                'pimpinan' => 'Warsono',
                'bidang' => 'Teknologi Informasi',
                'alamat' => 'Dusun Plosowedi, Desa Plosogeneng, Kecamatan Jombang, Kabupaten Jombang',
                'created_at' => now()
            ],
            [
                'nama_industri' => 'CV. Alexa Cipta Takindo',
                'pimpinan' => 'Falah Andhika',
                'bidang' => 'Percetakan dan Desain Grafis',
                'alamat' => 'Desa Bawangan, Kecamatan Ploso, Kabupaten Jombang',
                'created_at' => now()
            ],
            [
                'nama_industri' => 'ZAS Digital Printing',
                'pimpinan' => 'Subhan',
                'bidang' => 'Percetakan dan Desain Grafis',
                'alamat' => 'Jl. KH. Agus Salim, Jombatan, Kecamatan Jombang, Kabupaten Jombang',
                'created_at' => now()
            ],
            [
                'nama_industri' => 'Duta Grafika Offset',
                'pimpinan' => 'Moch. Asyfuddin',
                'bidang' => 'Percetakan dan Desain Grafis',
                'alamat' => 'Tambakberas, Kecamatan Jombang, Kabupaten Jombang',
                'created_at' => now()
            ],
            [
                'nama_industri' => 'PT. Artha Lintas Data Mandiri',
                'pimpinan' => 'Rohimin',
                'bidang' => 'Teknologi Informasi',
                'alamat' => 'Dusun Sumberwinong, Desa Banjardowo, Kecamatan Jombang, Kabupaten Jombang',
                'created_at' => now()
            ],
            [
                'nama_industri' => 'PT. Lintas Data Prima Tambakberas',
                'pimpinan' => 'Wahyu Imam Hasani',
                'bidang' => 'Teknologi Informasi',
                'alamat' => 'Kalikejambon, Desa Tembelang, Kecamatan Jombang, Kabupaten Jombang',
                'created_at' => now()
            ],
            [
                'nama_industri' => 'BLK Sunan Ampel',
                'pimpinan' => 'Jakfar',
                'bidang' => 'Pelatihan Kerja',
                'alamat' => 'Dusun Sumberwinong, Desa Banjardowo, Kecamatan Jombang, Kabupaten Jombang',
                'created_at' => now()
            ],
        ];

        DB::table('industris')->insert($industries);
    }
}