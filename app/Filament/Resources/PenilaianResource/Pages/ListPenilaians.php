<?php

namespace App\Filament\Resources\PenilaianResource\Pages;

use App\Exports\PenilaianExport;
use App\Filament\Resources\PenilaianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListPenilaians extends ListRecords
{
    protected static string $resource = PenilaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\Action::make('export_Excel')
                ->label('Download Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function ($livewire) {
                    // Ambil data dari table yang sudah difilter
                    $records = $livewire->getFilteredTableQuery()->get();

                    // Simpan ke Excel dan return sebagai download
                    return Excel::download(new PenilaianExport($records), 'laporan-nilai-prakerin-siswa.xlsx');
                })
                ->requiresConfirmation()
        ];
    }
}
