<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembimbingResource\Pages;
use App\Models\Pembimbing;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembimbingResource extends Resource
{
    protected static ?string $model = Pembimbing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pembimbing')
                    ->label('Nama Pembimbing')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::where('role', 'pembimbing')->pluck('username', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('telp')
                    ->label('Nomor Telepon')
                    ->required()
                    ->tel()
                    ->maxLength(15),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pembimbing')
                    ->label('Nama Pembimbing')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telp')
                    ->label('Nomor Telepon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_kelompok')
                    ->label('Jumlah Kelompok')
                    ->getStateUsing(function ($record) {
                        return \App\Models\PembimbingKelompok::where('pembimbing_id', $record->id)->count();
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('pilih_kelompok')
                    ->label('Pilih Kelompok')
                    ->action(function (array $data, $record) {
                        \App\Models\PembimbingKelompok::create([
                            'pembimbing_id' => $record->id,
                            'kelompok_id' => $data['kelompok_id'],
                        ]);
                    })
                    ->form([
                        Forms\Components\Hidden::make('pembimbing_id')
                            ->default(function ($record) {
                                return $record->id;
                            }),
                        Forms\Components\TextInput::make('nama')
                            ->label('Pembimbing')
                            ->disabled()
                            ->default(function ($record) {
                                return $record->nama_pembimbing;
                            }),
                        Forms\Components\Select::make('kelompok_id')
                            ->label('Kelompok')
                            ->options(\App\Models\Kelompok::whereDoesntHave('pembimbingKelompok')->pluck('nama_kelompok', 'id'))
                            ->searchable()
                            ->required(),
                    ])
                    ->modalWidth(MaxWidth::Small)
                    ->modalAlignment(Alignment::Center)
                    ->color('success')
                    ->icon('heroicon-s-user-group')
                    ->modalIcon('heroicon-s-user-group')
                    ->modalIconColor('success')
                    ->modalHeading('Pilih Kelompok')
                    ->modalButton('Simpan'),
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
            'index' => Pages\ManagePembimbings::route('/'),
        ];
    }
}