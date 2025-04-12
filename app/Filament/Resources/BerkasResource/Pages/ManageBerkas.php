<?php

namespace App\Filament\Resources\BerkasResource\Pages;

use App\Filament\Resources\BerkasResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBerkas extends ManageRecords
{
    protected static string $resource = BerkasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth('md'),
        ];
    }
}
