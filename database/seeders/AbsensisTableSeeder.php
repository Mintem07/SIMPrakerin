<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsensisTableSeeder extends Seeder
{
    private $kegiatanTKJHadir = [
        'Melakukan instalasi jaringan komputer di lab sekolah',
        'Belajar konfigurasi router Cisco Packet Tracer',
        'Praktik membuat kabel jaringan straight dan crossover',
        'Mempelajari dasar-dasar pemrograman web dengan HTML',
        'Melakukan perakitan dan troubleshooting komputer',
        'Praktik instalasi sistem operasi Windows dan Linux',
        'Belajar administrasi server menggunakan Ubuntu Server',
        'Mempelajari dasar-dasar keamanan jaringan komputer',
        'Praktik membuat aplikasi sederhana dengan Python',
        'Belajar konfigurasi jaringan nirkabel di sekolah',
        'Melakukan maintenance perangkat jaringan komputer',
        'Praktik membuat database sederhana dengan MySQL',
        'Belajar dasar-dasar cloud computing dengan GCP',
        'Mempelajari IoT dasar dengan Arduino dan sensor',
        'Praktik membuat desain antarmuka menggunakan Figma',
        'Belajar digital marketing untuk produk IT',
        'Melakukan presentasi hasil praktikum jaringan',
        'Praktik membuat aplikasi mobile sederhana',
        'Belajar monitoring jaringan menggunakan PRTG',
        'Melakukan simulasi helpdesk IT support'
    ];

    private $kegiatanPercetakanHadir = [
        'Belajar desain grafis menggunakan CorelDraw dan Photoshop',
        'Praktik operasional mesin cetak digital printing',
        'Melakukan finishing produk cetak dengan laminating',
        'Praktik sablon manual kaos dan bahan lainnya',
        'Mempelajari teknik offset printing dasar',
        'Praktik membuat banner dan spanduk besar',
        'Belajar membuat stiker dengan berbagai bahan',
        'Praktik produksi brosur dan leaflet promosi',
        'Melakukan pembuatan undangan pernikahan custom',
        'Belajar membuat kartu nama dengan berbagai desain',
        'Praktik produksi kalender dinding dan meja',
        'Mempelajari teknik binding untuk buku dan majalah',
        'Praktik membuat packaging produk makanan',
        'Belajar membuat label produk dengan barcode',
        'Melakukan produksi x-banner untuk event',
        'Praktik membuat roll banner ukuran besar',
        'Belajar instalasi neon box untuk toko',
        'Mempelajari teknik pembuatan billboard outdoor',
        'Praktik cutting sticker dengan plotter cutter',
        'Melakukan quality control produk cetakan'
    ];

    private $kegiatanSakit = [
        'Istirahat di rumah karena demam dan flu',
        'Pulang lebih awal karena sakit kepala',
        'Tidak masuk karena gejala sakit perut',
        'Istirahat total atas anjuran dokter',
        'Mengikuti pembelajaran daring karena sakit'
    ];

    private $kegiatanIzin = [
        'Menghadiri acara keluarga yang penting',
        'Mengikuti lomba di sekolah lain',
        'Menghadiri undangan pernikahan saudara',
        'Mengantar orang tua ke rumah sakit',
        'Menghadiri kegiatan OSIS di luar sekolah'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data siswa yang sudah tergabung dalam kelompok
        $siswas = DB::table('siswas')
            ->join('anggota_kelompoks', 'siswas.id', '=', 'anggota_kelompoks.siswa_id')
            ->join('kelompoks', 'anggota_kelompoks.kelompok_id', '=', 'kelompoks.id')
            ->join('pembimbing_kelompoks', 'kelompoks.id', '=', 'pembimbing_kelompoks.kelompok_id')
            ->select(
                'siswas.id as siswa_id',
                'kelompoks.id as kelompok_id',
                'pembimbing_kelompoks.pembimbing_id as pembimbing_id',
                'kelompoks.industri_id'
            )
            ->get();

        if ($siswas->isEmpty()) {
            $this->command->error('Tidak ada siswa yang tergabung dalam kelompok!');
            return;
        }

        $startDate = Carbon::create(2024, 8, 12); // Senin, 12 Agustus 2024
        $absensiData = [];

        foreach ($siswas as $siswa) {
            $totalAbsensi = 0;
            $currentDate = $startDate->copy();
            $isSiswaRajin = rand(0, 1); // 50% chance menjadi siswa rajin
            $isSiswaSpesial = in_array($siswa->siswa_id, [9, 21, 31]);

            // Aturan absensi berdasarkan tipe siswa
            if ($isSiswaSpesial) {
                $maxAbsensi = rand(2, 4); // Siswa spesial hanya absen 2-4 kali
            } elseif ($isSiswaRajin) {
                $maxAbsensi = 10; // Siswa rajin absen semua
            } else {
                $maxAbsensi = rand(7, 9); // Siswa normal absen 7-9 kali
            }

            while ($totalAbsensi < $maxAbsensi && $totalAbsensi < 10) {
                // Skip weekend berdasarkan aturan
                $isWeekend = $currentDate->isWeekend();
                $liburSabtuMinggu = rand(0, 1); // 50% chance libur sabtu dan minggu
                $liburMingguSaja = !$liburSabtuMinggu;

                if (($isWeekend && $liburSabtuMinggu) || 
                    ($currentDate->isSunday() && $liburMingguSaja)) {
                    $currentDate->addDay();
                    continue;
                }

                // Tentukan keterangan absensi
                if ($isSiswaSpesial && rand(0, 3) == 0) { // 25% chance hadir untuk siswa spesial
                    $keterangan = 'Hadir';
                } elseif ($isSiswaRajin) {
                    $keterangan = 'Hadir';
                } else {
                    $rand = rand(1, 100);
                    if ($rand <= 80) {
                        $keterangan = 'Hadir';
                    } elseif ($rand <= 95) {
                        $keterangan = 'Izin';
                    } else {
                        $keterangan = 'Sakit';
                    }
                }

                // Tentukan kegiatan berdasarkan keterangan
                if ($keterangan === 'Hadir') {
                    $kegiatanList = ($siswa->industri_id % 2 == 0) ? 
                        $this->kegiatanPercetakanHadir : $this->kegiatanTKJHadir;
                } elseif ($keterangan === 'Sakit') {
                    $kegiatanList = $this->kegiatanSakit;
                } else {
                    $kegiatanList = $this->kegiatanIzin;
                }

                $kegiatan = $kegiatanList[array_rand($kegiatanList)];

                $absensiData[] = [
                    'siswa_id' => $siswa->siswa_id,
                    'kelompok_id' => $siswa->kelompok_id,
                    'pembimbing_id' => $siswa->pembimbing_id,
                    'tanggal' => $currentDate->toDateString(),
                    'keterangan' => $keterangan,
                    'kegiatan' => $kegiatan,
                    'foto_kegiatan' => 'activity_'.rand(1, 7).'.jpg',
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $totalAbsensi++;
                $currentDate->addDay();

                // Skip beberapa hari untuk membuat lebih realistis
                if (rand(0, 3) == 0) { // 25% chance skip 1-2 hari
                    $currentDate->addDays(rand(1, 2));
                }
            }
        }

        // Insert data absensi
        DB::table('absensis')->insert($absensiData);

        $this->command->info('Seeder Absensi berhasil dijalankan!');
        $this->command->info('Total absensi yang dibuat: ' . count($absensiData));
        $this->command->info('Detail kegiatan:');
        $this->command->info('- TKJ Hadir: ' . count($this->kegiatanTKJHadir) . ' opsi');
        $this->command->info('- Percetakan Hadir: ' . count($this->kegiatanPercetakanHadir) . ' opsi');
        $this->command->info('- Sakit: ' . count($this->kegiatanSakit) . ' opsi');
        $this->command->info('- Izin: ' . count($this->kegiatanIzin) . ' opsi');
    }
}