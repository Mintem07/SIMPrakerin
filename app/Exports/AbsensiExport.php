<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping
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
            'Siswa',
            'Kelompok',
            'Pembimbing',
            'Tanggal Absensi',
            'Keterangan',
            'Kegiatan',
            'Foto Kegiatan',
            'Catatan Pembimbing',
            'Tanggal Catatan'
        ];
    }

    public function map($absensi): array
    {
        $link = $absensi->foto_kegiatan 
        ? url('storage/absensi/' . $absensi->foto_kegiatan) 
        : '';

        return [
            $absensi->siswa->nama_siswa ?? '-',
            $absensi->kelompok->nama_kelompok ?? '-',
            $absensi->pembimbing->nama_pembimbing ?? '-',
            $absensi->tanggal ?? '-',
            $absensi->keterangan ?? '-',
            $absensi->kegiatan ?? '-',
            $link ? '=HYPERLINK("' . $link . '", "Lihat Foto")' : '',
            $absensi->catatanPembimbing->catatan ?? '-',
            $absensi->catatanPembimbing->created_at ?? '-',
        ];
    }
}
