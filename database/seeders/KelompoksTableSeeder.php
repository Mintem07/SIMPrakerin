<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelompoksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelompokData = [
            [
                'nama_kelompok' => 'Kelompok 1',
                'industri_id' => 1,
                'status' => 'diterima',
                'created_at' => now()
            ],
            [
                'nama_kelompok' => 'Kelompok 2',
                'industri_id' => 2,
                'status' => 'diterima',
                'created_at' => now()
            ],
            [
                'nama_kelompok' => 'Kelompok 3',
                'industri_id' => 3,
                'status' => 'diterima',
                'created_at' => now()
            ],
            [
                'nama_kelompok' => 'Kelompok 4',
                'industri_id' => 4,
                'status' => 'diterima',
                'created_at' => now()
            ],
            [
                'nama_kelompok' => 'Kelompok 5',
                'industri_id' => 5,
                'status' => 'diterima',
                'created_at' => now()
            ],
            [
                'nama_kelompok' => 'Kelompok 6',
                'industri_id' => 6,
                'status' => 'diterima',
                'created_at' => now()
            ],
            [
                'nama_kelompok' => 'Kelompok 7',
                'industri_id' => 7,
                'status' => 'diterima',
                'created_at' => now()
            ],
        ];

        DB::table('kelompoks')->insert($kelompokData);

        // Siswa yang tidak boleh dalam satu kelompok
        $specialStudents = [9, 21, 31];
        
        // Siswa yang akan digunakan (32 siswa dikurangi 4 siswa yang tidak akan dibuatkan kelompok)
        $availableStudents = range(1, 32);
        
        // Siswa yang tidak akan dibuatkan kelompok (4 siswa acak, kecuali siswa spesial)
        $excludedStudents = array_diff($availableStudents, $specialStudents);
        shuffle($excludedStudents);
        $excludedStudents = array_slice($excludedStudents, 0, 4);
        
        // Siswa yang akan dibagi ke dalam kelompok
        $studentsForGroups = array_diff($availableStudents, $excludedStudents);
        shuffle($studentsForGroups); // Acak urutan siswa
        
        // Pastikan siswa spesial tidak dalam satu kelompok
        $specialGroupsAssigned = [];
        
        $anggotaData = [];
        $kelompokCount = count($kelompokData);
        
        foreach ($kelompokData as $index => $kelompok) {
            $kelompokId = $index + 1;
            $members = [];
            
            // Ambil 4 siswa untuk kelompok ini
            for ($i = 0; $i < 4 && !empty($studentsForGroups); $i++) {
                $found = false;
                $attempts = 0;
                
                // Cari siswa yang memenuhi syarat
                while (!$found && $attempts < 100) {
                    $attempts++;
                    $studentId = array_shift($studentsForGroups);
                    
                    // Jika siswa spesial, pastikan belum ada di kelompok yang sama
                    if (in_array($studentId, $specialStudents)) {
                        if (!in_array($studentId, $specialGroupsAssigned)) {
                            $specialGroupsAssigned[$studentId] = $kelompokId;
                            $found = true;
                        } else {
                            // Kembalikan ke array dan coba lagi
                            array_push($studentsForGroups, $studentId);
                            shuffle($studentsForGroups);
                            continue;
                        }
                    } else {
                        $found = true;
                    }
                }
                
                if ($found) {
                    $members[] = $studentId;
                }
            }
            
            // Tambahkan ke data anggota
            foreach ($members as $member) {
                $anggotaData[] = [
                    'kelompok_id' => $kelompokId,
                    'siswa_id' => $member,
                    'created_at' => now()
                ];
            }
        }

        DB::table('anggota_kelompoks')->insert($anggotaData);
        
        // Output untuk informasi (bisa dihapus setelah testing)
        echo "Siswa yang tidak dibuatkan kelompok: " . implode(', ', $excludedStudents) . "\n";
    }
}