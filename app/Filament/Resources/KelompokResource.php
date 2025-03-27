<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelompokResource\Pages;
use App\Filament\Resources\KelompokResource\RelationManagers;
use App\Models\Kelompok;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\View\View;

class KelompokResource extends Resource
{
    protected static ?string $model = Kelompok::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kelompok')
                    ->label('Nama Kelompok')
                    ->disabled()
                    ->required(),
                Forms\Components\Select::make('industri_id')
                    ->label('Nama Industri')
                    ->relationship('industri', 'nama_industri')
                    ->disabled()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kelompok')->label('Nama Kelompok'),
                Tables\Columns\TextColumn::make('industri.nama_industri')->label('Nama Industri'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('viewAnggota')
                    ->label('Anggota')
                    ->color('info')
                    ->icon('heroicon-s-users')
                    ->modalWidth(MaxWidth::ExtraSmall)
                    ->modalContent(fn (Kelompok $record): View => view(
                        'filament.resources.kelompok.modal.view-anggota',
                        ['anggota' => $record->anggotaKelompok],
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false),
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
            'index' => Pages\ManageKelompoks::route('/'),
        ];
    }
}
