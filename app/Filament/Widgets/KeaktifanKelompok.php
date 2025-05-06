<?php

namespace App\Filament\Widgets;

use App\Models\Absensi;
use App\Models\Kelompok;
use App\Models\Penjadwalan;
use Filament\Forms\Components\DatePicker;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class KeaktifanKelompok extends ChartWidget
{
    protected static ?string $heading = 'Keaktifan Kelompok';

    protected int | string | array $columnSpan = [
        'lg' => 2,
    ];

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        // Cari penjadwalan "pelaksanaan"
        $jadwal = Penjadwalan::where('kegiatan', 'pelaksanaan')->first();

        // Default tanggal jika tidak ada penjadwalan
        $start = $jadwal ? Carbon::parse($jadwal->tgl_mulai) : now()->subWeek();
        $end = $jadwal ? Carbon::parse($jadwal->tgl_selesai) : now();

        $labels = [];
        $datasets = [];

        // Buat array tanggal untuk sumbu X
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $labels[] = $date->toDateString();
        }

        // Ambil semua kelompok
        $kelompoks = Kelompok::all();
        $palette = $this->getColorPalette();
        $colorIndex = 0;

        foreach ($kelompoks as $kelompok) {
            $absensi = Absensi::where('kelompok_id', $kelompok->id)
                ->where('keterangan', 'hadir')
                ->whereBetween('tanggal', [$start, $end])
                ->get()
                ->groupBy('tanggal');

            $data = [];
            foreach ($labels as $tanggal) {
                $data[] = isset($absensi[$tanggal]) ? $absensi[$tanggal]->count() : 0;
            }

            $color = $palette[$colorIndex % count($palette)];
            $datasets[] = [
                'label' => $kelompok->nama_kelompok,
                'data' => $data,
                'fill' => false,
                'borderColor' => $color,
                'backgroundColor' => str_replace(', 1)', ', 0.4)', $color),
            ];

            $colorIndex++;
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getColorPalette(): array
    {
        return [
            'rgba(255, 99, 132, 1)',    // Merah
            'rgba(54, 162, 235, 1)',    // Biru
            'rgba(255, 206, 86, 1)',    // Kuning
            'rgba(75, 192, 192, 1)',    // Tosca
            'rgba(153, 102, 255, 1)',   // Ungu
            'rgba(255, 159, 64, 1)',    // Oranye
            'rgba(199, 199, 199, 1)',   // Abu-abu
            'rgba(255, 99, 255, 1)',    // Pink
            'rgba(100, 255, 218, 1)',   // Aqua
            'rgba(0, 200, 83, 1)',      // Hijau Terang
            'rgba(255, 87, 34, 1)',     // Oranye Tua
            'rgba(63, 81, 181, 1)',     // Biru Tua
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}