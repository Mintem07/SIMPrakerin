<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'userId' => 1,
                'nama_siswa' => 'Achmad Falah Abdillah',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Plosokendal, Plosogeneng, Kec. Jombang, 61416',
                'telp' => '082335307166',
                'created_at' => now()
            ],
            [
                'userId' => 2,
                'nama_siswa' => 'Afza Izam Nazarudi',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Banjardowo, Banjardowo, Kec. Jombang, 61418',
                'telp' => '085232600488',
                'created_at' => now()
            ],
            [
                'userId' => 3,
                'nama_siswa' => 'Aldo Prayoga',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61419',
                'telp' => '085755250113',
                'created_at' => now()
            ],
            [
                'userId' => 4,
                'nama_siswa' => 'Alisa Lu\'luin Salsabila',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Sumberwinong, Banjardowo, Kec. Jombang, 61419',
                'telp' => '085790503350',
                'created_at' => now()
            ],
            [
                'userId' => 5,
                'nama_siswa' => 'Ananda Putra',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Tegal Rejo, Desa/Kel. Pacar Peluk, Kec. Megaluh, 61457',
                'telp' => '085732284929',
                'created_at' => now()
            ],
            [
                'userId' => 6,
                'nama_siswa' => 'Avan Roberto',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Gedangkeret, Banjardowo, Kec. Jombang, 61418',
                'telp' => '085648310450',
                'created_at' => now()
            ],
            [
                'userId' => 7,
                'nama_siswa' => 'Ayu Wulandari',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61418',
                'telp' => '085755611044',
                'created_at' => now()
            ],
            [
                'userId' => 8,
                'nama_siswa' => 'Bagas Irwansah',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Bajardowo, Banjardowo, Kec. Jombang, 61419',
                'telp' => '0895336364555',
                'created_at' => now()
            ],
            [
                'userId' => 9,
                'nama_siswa' => 'Budi Setio Utomo',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61451',
                'telp' => '085730256531',
                'created_at' => now()
            ],
            [
                'userId' => 10,
                'nama_siswa' => 'Elang Jawa',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Plosokendal, Plosogeneng, Kec. Jombang, 61416',
                'telp' => '085792261592',
                'created_at' => now()
            ],
            [
                'userId' => 11,
                'nama_siswa' => 'Eva Mei Wuladari',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Banjardowo, Banjardowo, Kec. Jombang, 61450',
                'telp' => '081233422708',
                'created_at' => now()
            ],
            [
                'userId' => 12,
                'nama_siswa' => 'Frengky Galang Saputra',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Plosokendal, Desa/Kel. Plosogeneng, Kec. Jombang, 61451',
                'telp' => '081233422692',
                'created_at' => now()
            ],
            [
                'userId' => 13,
                'nama_siswa' => 'Gigih Bayu Anri Fahrezi',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Plosokendal, Plosogeneng, Kec. Jombang, 61416',
                'telp' => '082132269714',
                'created_at' => now()
            ],
            [
                'userId' => 14,
                'nama_siswa' => 'Imatul Hidayah',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Banjarkerep, Banjardowo, Kec. Jombang, 61451',
                'telp' => '',
                'created_at' => now()
            ],
            [
                'userId' => 15,
                'nama_siswa' => 'Iskaq Ma\'ruf Firlana',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61451',
                'telp' => '081553734816',
                'created_at' => now()
            ],
            [
                'userId' => 16,
                'nama_siswa' => 'Kaka Sandi',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Plosokendal, Plosogeneng, Kec. Jombang, 61415',
                'telp' => '085790852790',
                'created_at' => now()
            ],
            [
                'userId' => 17,
                'nama_siswa' => 'Luluk Fahrida',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jeruklegi, Balongbendo, Kec. Balong Bendo, 61263',
                'telp' => '082131031114',
                'created_at' => now()
            ],
            [
                'userId' => 18,
                'nama_siswa' => 'Lutfi Agus Tri Anggara',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sumberwinong, Banjardowo, Kec. Jombang, 61451',
                'telp' => '',
                'created_at' => now()
            ],
            [
                'userId' => 19,
                'nama_siswa' => 'Moch. Ardiansyah',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Plosokendal, Plosogeneng, Kec. Jombang, 61415',
                'telp' => '',
                'created_at' => now()
            ],
            [
                'userId' => 20,
                'nama_siswa' => 'Mochamad Raditiyah Adi Pratama',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Denanyar, Kec. Jombang, 61415',
                'telp' => '085730253536',
                'created_at' => now()
            ],
            [
                'userId' => 21,
                'nama_siswa' => 'Mohamad Reza Aulinuha',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Banjardowo, Banjardowo, Kec. Jombang, 61419',
                'telp' => '085806023184',
                'created_at' => now()
            ],
            [
                'userId' => 22,
                'nama_siswa' => 'Mohammad Aji',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Kedungsari, Balongsari, Kec. Megaluh, 61457',
                'telp' => '085895364511',
                'created_at' => now()
            ],
            [
                'userId' => 23,
                'nama_siswa' => 'Mufid Prasti',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Porwodadi, Banjardowo, Kec. Jombang, 61451',
                'telp' => '085755197154',
                'created_at' => now()
            ],
            [
                'userId' => 24,
                'nama_siswa' => 'Muhamad Bagus Yulianto',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sukorejo, Desa/Kel. Sukorejo, Kec. Perak, 61459',
                'telp' => '088805231864',
                'created_at' => now()
            ],
            [
                'userId' => 25,
                'nama_siswa' => 'Muhammad Fa\'izin',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sebani, Sebani, Kec. Sumobito, 61483',
                'telp' => '082225550023',
                'created_at' => now()
            ],
            [
                'userId' => 26,
                'nama_siswa' => 'Oktavia Diniyati',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61416',
                'telp' => '085730256592',
                'created_at' => now()
            ],
            [
                'userId' => 27,
                'nama_siswa' => 'Rafi Romadhoni',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Banjardowo, Banjardowo, Kec. Jombang, 61419',
                'telp' => '082231149558',
                'created_at' => now()
            ],
            [
                'userId' => 28,
                'nama_siswa' => 'Rafi Setiawan',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61419',
                'telp' => '085730597058',
                'created_at' => now()
            ],
            [
                'userId' => 29,
                'nama_siswa' => 'Rengga Satria Putra Budi',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Banjarkerep, Banjardowo, Kec. Jombang, 61451',
                'telp' => '085780305609',
                'created_at' => now()
            ],
            [
                'userId' => 30,
                'nama_siswa' => 'Riham Alya Soraya',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Desa/Kel. Banyu Urip, Kec. Sawahan, 60253',
                'telp' => '081554366865',
                'created_at' => now()
            ],
            [
                'userId' => 31,
                'nama_siswa' => 'Rizki Dwi Hermawan',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61451',
                'telp' => '085730597001',
                'created_at' => now()
            ],
            [
                'userId' => 32,
                'nama_siswa' => 'Romadhoni Eka Putra',
                'kelas' => '12',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sendangrejo, Banjardowo, Kec. Jombang, 61419',
                'telp' => '085748089610',
                'created_at' => now()
            ],
        ];

        DB::table('siswas')->insert($students);
    }
}
