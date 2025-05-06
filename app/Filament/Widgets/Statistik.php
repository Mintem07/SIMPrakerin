<?php

namespace App\Filament\Widgets;

use App\Models\Kelompok;
use App\Models\Siswa;
use App\Models\Pembimbing;
use App\Models\Industri;
use Filament\Support\Enums\Alignment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Statistik extends BaseWidget
{
    protected int | string | array $columnSpan = [
        'lg' => 1,
    ];
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengajuan', Kelompok::count()),
            Stat::make('Jumlah Siswa', Siswa::count()),
            Stat::make('Jumlah Pembimbing', Pembimbing::count()),
            Stat::make('Jumlah Industri', Industri::count()),
        ];
    }

    protected function getColumns(): int
    {
        return 2; // 2 kolom per baris
    }
}
