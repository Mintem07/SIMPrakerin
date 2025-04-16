<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BerkasResource\Pages;
use App\Filament\Resources\BerkasResource\RelationManagers;
use App\Models\Berkas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BerkasResource extends Resource
{
    protected static ?string $model = Berkas::class;

    public static function getPluralLabel(): string
    {
        return 'Kelola Berkas';
    }

    protected static ?string $navigationGroup = 'Manajemen Akademik';
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Kelola Berkas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nama_berkas')
                    ->label('Nama Berkas')
                    ->columnSpanFull()
                    ->required(),
                    Forms\Components\FileUpload::make('file_berkas')
                    ->label('File')
                    ->directory('berkas')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nama_berkas')
                    ->label('Nama Berkas'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBerkas::route('/'),
        ];
    }
}
