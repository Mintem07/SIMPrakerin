<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\CatatanPembimbing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatatanTableSeeder extends Seeder
{
    public function run(): void
    {
        $umumNotes = [
            'Terus pertahankan semangat dan disiplin dalam menjalani kegiatan hari ini.',
            'Kehadiranmu hari ini memberikan energi positif untuk seluruh tim.',
            'Kinerja hari ini cukup baik, teruslah konsisten dan tingkatkan lagi.',
            'Sikapmu yang aktif sangat membantu jalannya kegiatan hari ini.',
            'Hari ini kamu menunjukkan kedisiplinan yang patut dicontoh oleh teman-teman.',
            'Kerja sama tim yang kamu tunjukkan hari ini sangat mengesankan.',
            'Tugas hari ini kamu kerjakan dengan baik dan sesuai arahan.',
            'Terima kasih atas kontribusi aktifmu selama kegiatan hari ini.',
            'Disiplin waktu hari ini cukup baik, terus dipertahankan.',
            'Partisipasimu hari ini sangat membangun suasana kerja yang kondusif.',
            'Sikap positifmu hari ini membuat suasana menjadi lebih nyaman.',
            'Semangat belajarmu hari ini luar biasa, terus pertahankan ya.',
            'Kamu mampu menyelesaikan tugas dengan cepat dan tepat.',
            'Hari ini kamu terlihat lebih fokus, semoga bisa konsisten.',
            'Kerja kerasmu hari ini sangat kami hargai, lanjutkan!'
        ];

        $sakitNotes = [
            'Semoga segera pulih dan tetap semangat untuk mengikuti kegiatan selanjutnya.',
            'Jaga kesehatan dan jangan lupa istirahat yang cukup agar bisa segera aktif kembali.',
            'Walaupun sakit, tetap semangat ya. Kesempatan belajar akan selalu ada.',
            'Kesehatan sangat penting, tetap jaga pola makan dan waktu tidur.',
            'Sakit memang tidak bisa dihindari, yang penting tetap tanggung jawab.',
            'Semoga kondisi segera membaik dan bisa kembali beraktivitas seperti biasa.',
            'Selalu siapkan kondisi fisik agar tetap bugar dan bisa hadir secara rutin.',
            'Jika ada kesulitan selama sakit, jangan ragu untuk bertanya kepada pembimbing.',
        ];

        $izinNotes = [
            'Jangan terlalu sering izin, usahakan hadir agar tidak tertinggal materi.',
            'Selalu beri kabar dengan jelas jika tidak bisa hadir, itu sangat membantu kami.',
            'Jangan lupa cek tugas yang tertinggal saat kamu tidak hadir.',
            'Semangat terus meskipun hari ini tidak bisa ikut kegiatan.',
            'Izinmu kami maklumi, namun tetap jaga tanggung jawab terhadap tugas ya.',
            'Ingat bahwa konsistensi kehadiran juga memengaruhi pembelajaranmu.',
            'Pastikan untuk mengganti waktu belajar yang hilang selama kamu izin.',
        ];

        $absensis = Absensi::all();
        $absensisToInsert = $absensis->random(rand(
            (int)($absensis->count() * 0.7),
            (int)($absensis->count() * 0.8)
        ));

        foreach ($absensisToInsert as $absensi) {
            $status = strtolower($absensi->keterangan);
            $note = match ($status) {
                'hadir' => fake()->randomElement($umumNotes),
                'sakit' => fake()->randomElement($sakitNotes),
                'izin' => fake()->randomElement($izinNotes),
                default => null,
            };

            // Lewatkan jika status tidak dikenal
            if (!$note) continue;

            $createdAt = \Carbon\Carbon::parse($absensi->tanggal)
                ->setHour(rand(14, 17)) // sore hari antara jam 2 - 5 sore
                ->setMinute(rand(0, 59));

            CatatanPembimbing::create([
                'absensi_id' => $absensi->id,
                'catatan' => $note,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
