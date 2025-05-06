<?php

namespace App\Filament\Widgets;

use App\Models\Penilaian;
use Filament\Widgets\ChartWidget;

class Kelulusan extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kelulusan';

    protected int | string | array $columnSpan = [
        'lg' => 1,
    ];
    protected static ?int $sort = 1;
    protected static ?string $maxHeight = '145px';

    protected function getData(): array
    {
        // Ambil data jumlah status
        $data = Penilaian::select('status')
        ->selectRaw('count(*) as total')
        ->groupBy('status')
        ->pluck('total', 'status')
        ->toArray();

        // Pastikan label tetap konsisten (meskipun tidak ada datanya)
        $statuses = ['Lulus', 'Tidak Lulus', 'Pending'];

        // Mapping ke format chart
        $labels = [];
        $values = [];

        foreach ($statuses as $status) {
            $labels[] = $status;
            $values[] = $data[$status] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Siswa',
                    'data' => $values,
                    'backgroundColor' => ['#10B981', '#EF4444', '#F59E0B'], // warna untuk Lulus, Tidak Lulus, Pending
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => false,
                    'grid' => ['display' => false],
                ],
                'y' => [
                    'display' => false,
                    'grid' => ['display' => false],
                ],
            ],
        ];
    }
}
