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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Seed data untuk tabel `users` (15 data: 12 siswa + 3 pembimbing)
        $users = [
            // Data untuk siswa (12 data)
            [
                'username' => 'siswa1',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa2',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa3',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa4',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa5',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa6',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa7',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa8',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa9',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa10',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa11',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'username' => 'siswa12',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],

            // Data untuk pembimbing (3 data)
            [
                'username' => 'pembimbing1',
                'password' => Hash::make('password'),
                'role' => 'pembimbing',
            ],
            [
                'username' => 'pembimbing2',
                'password' => Hash::make('password'),
                'role' => 'pembimbing',
            ],
            [
                'username' => 'pembimbing3',
                'password' => Hash::make('password'),
                'role' => 'pembimbing',
            ],
        ];
        DB::table('users')->insert($users);

        // Seed data untuk tabel `siswas` (12 data)
        $siswas = [
            [
                'userId' => 1, // Sesuaikan dengan ID user yang memiliki role 'siswa'
                'nama_siswa' => 'Siswa Satu',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '081234567890',
                'alamat' => 'Jl. Contoh No. 1',
            ],
            [
                'userId' => 2,
                'nama_siswa' => 'Siswa Dua',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'telp' => '081234567891',
                'alamat' => 'Jl. Contoh No. 2',
            ],
            [
                'userId' => 3,
                'nama_siswa' => 'Siswa Tiga',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '081234567892',
                'alamat' => 'Jl. Contoh No. 3',
            ],
            [
                'userId' => 4,
                'nama_siswa' => 'Siswa Empat',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'telp' => '081234567893',
                'alamat' => 'Jl. Contoh No. 4',
            ],
            [
                'userId' => 5,
                'nama_siswa' => 'Siswa Lima',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '081234567894',
                'alamat' => 'Jl. Contoh No. 5',
            ],
            [
                'userId' => 6,
                'nama_siswa' => 'Siswa Enam',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'telp' => '081234567895',
                'alamat' => 'Jl. Contoh No. 6',
            ],
            [
                'userId' => 7,
                'nama_siswa' => 'Siswa Tujuh',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '081234567896',
                'alamat' => 'Jl. Contoh No. 7',
            ],
            [
                'userId' => 8,
                'nama_siswa' => 'Siswa Delapan',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'telp' => '081234567897',
                'alamat' => 'Jl. Contoh No. 8',
            ],
            [
                'userId' => 9,
                'nama_siswa' => 'Siswa Sembilan',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '081234567898',
                'alamat' => 'Jl. Contoh No. 9',
            ],
            [
                'userId' => 10,
                'nama_siswa' => 'Siswa Sepuluh',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'telp' => '081234567899',
                'alamat' => 'Jl. Contoh No. 10',
            ],
            [
                'userId' => 11,
                'nama_siswa' => 'Siswa Sebelas',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Laki-laki',
                'telp' => '081234567800',
                'alamat' => 'Jl. Contoh No. 11',
            ],
            [
                'userId' => 12,
                'nama_siswa' => 'Siswa Dua Belas',
                'kelas' => 'XI',
                'jurusan' => 'TKJ',
                'jenis_kelamin' => 'Perempuan',
                'telp' => '081234567811',
                'alamat' => 'Jl. Contoh No. 12',
            ],
        ];
        DB::table('siswas')->insert($siswas);

        // Seed data untuk tabel `pembimbings` (3 data)
        $pembimbings = [
            [
                'user_id' => 13, // Sesuaikan dengan ID user yang memiliki role 'pembimbing'
                'nama_pembimbing' => 'Pembimbing Satu',
                'telp' => '081234567812',
            ],
            [
                'user_id' => 14,
                'nama_pembimbing' => 'Pembimbing Dua',
                'telp' => '081234567813',
            ],
            [
                'user_id' => 15,
                'nama_pembimbing' => 'Pembimbing Tiga',
                'telp' => '081234567814',
            ],
        ];
        DB::table('pembimbings')->insert($pembimbings);
    }
}
