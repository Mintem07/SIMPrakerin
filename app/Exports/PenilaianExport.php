<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenilaianExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Penilaian::with(['siswa', 'kelompok', 'pembimbing']);

        // Apply filters if present
        if (isset($this->filters['kelompok_id'])) {
            $query->where('kelompok_id', $this->filters['kelompok_id']);
        }

        if (isset($this->filters['pembimbing_id'])) {
            $query->where('pembimbing_id', $this->filters['pembimbing_id']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Kelompok',
            'Pembimbing',
            'Nilai Rata-rata',
            'Nilai Laporan',
            'Status'
        ];
    }

    public function map($penilaian): array
    {
        return [
            $penilaian->siswa->nama_siswa,
            $penilaian->kelompok->nama_kelompok,
            $penilaian->pembimbing->nama_pembimbing,
            $penilaian->average_poin,
            $penilaian->report_poin,
            $penilaian->status,
        ];
    }
}
