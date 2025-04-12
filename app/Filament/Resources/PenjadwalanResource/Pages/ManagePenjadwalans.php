<?php

namespace App\Filament\Resources\PenjadwalanResource\Pages;

use App\Filament\Resources\PenjadwalanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePenjadwalans extends ManageRecords
{
    protected static string $resource = PenjadwalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
