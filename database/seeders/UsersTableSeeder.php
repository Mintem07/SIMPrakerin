<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'mintemart@gmail.com',
            'password' => Hash::make('minest07'),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);

        // siswa
        $students = [
            [
                'username' => '0074181041',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0063696687',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0061464106',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0068289973',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0071014483',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0065806510',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0067742130',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0069750417',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0063853321',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0081271411',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0075502259',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0076075393',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0064449647',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0079358201',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0075292644',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0074798763',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0072840159',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0066851446',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0077052544',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0062741021',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0063512487',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0064344626',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0058770688',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0064717629',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0071004016',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0058858152',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0068663004',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0055669065',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0069164832',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0067058064',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0058546903',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
            [
                'username' => '0065030185',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now()
            ],
        ];

        DB::table('users')->insert($students);

        // pembimbing
        $teachers = [
            [
                'username' => 'pembimbing1',
                'password' => Hash::make('password123'),
                'role' => 'pembimbing',
                'created_at' => now()
            ],
            [
                'username' => 'pembimbing2',
                'password' => Hash::make('password123'),
                'role' => 'pembimbing',
                'created_at' => now()
            ],
            [
                'username' => 'pembimbing3',
                'password' => Hash::make('password123'),
                'role' => 'pembimbing',
                'created_at' => now()
            ],
            [
                'username' => 'pembimbing4',
                'password' => Hash::make('password123'),
                'role' => 'pembimbing',
                'created_at' => now()
            ],
            [
                'username' => 'pembimbing5',
                'password' => Hash::make('password123'),
                'role' => 'pembimbing',
                'created_at' => now()
            ],
        ];

        DB::table('users')->insert($teachers);

        // kepsek
        $headmaster = [
            [
                'username' => 'kepsek',
                'password' => Hash::make('password123'),
                'role' => 'kepsek',
                'created_at' => now()
            ],
        ];

        DB::table('users')->insert($headmaster);
    }
}
