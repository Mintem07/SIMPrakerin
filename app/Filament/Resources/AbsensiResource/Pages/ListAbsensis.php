<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Exports\AbsensiExport;
use App\Filament\Resources\AbsensiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListAbsensis extends ListRecords
{
    protected static string $resource = AbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\Action::make('export_excel')
            ->label('Export Absensi')
            ->icon('heroicon-o-arrow-down-tray')
            ->action(function ($livewire) {
                $records = $livewire->getFilteredTableQuery()
                    ->with(['siswa', 'kelompok', 'pembimbing', 'catatanPembimbing'])
                    ->get();

                return Excel::download(new AbsensiExport($records), 'laporan-absensi.xlsx');
            })
            ->requiresConfirmation(),
        ];
    }
}
