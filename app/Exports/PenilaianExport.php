<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class PenilaianExport implements FromCollection, WithHeadings, WithMapping
{
    protected $records;

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Kelompok',
            'Pembimbing',
            'Nilai Rata-rata',
            'Nilai Laporan',
            'Status',
            'Bukti Form Penilaian'
        ];
    }

    public function map($penilaian): array
    {
        $link = $penilaian->form_bukti 
        ? url('storage/bukti_nilai/' . $penilaian->form_bukti) 
        : '';

        return [
            $penilaian->siswa->nama_siswa ?? '',
            $penilaian->kelompok->nama_kelompok ?? '',
            $penilaian->pembimbing->nama_pembimbing ?? '',
            $penilaian->average_poin ?? '',
            $penilaian->report_poin ?? '',
            $penilaian->status ?? '',
            $link ? '=HYPERLINK("' . $link . '", "Lihat Bukti")' : '',
        ];
    }
}