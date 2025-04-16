<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjadwalanResource\Pages;
use App\Filament\Resources\PenjadwalanResource\RelationManagers;
use App\Models\Penjadwalan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenjadwalanResource extends Resource
{
    protected static ?string $model = Penjadwalan::class;

    public static function getPluralLabel(): string
    {
        return 'Kelola Jadwal';
    }

    protected static ?string $navigationGroup = 'Manajemen Akademik';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kelola Jadwal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kegiatan')
                ->required()
                ->maxLength(255),
                
                Forms\Components\DatePicker::make('tgl_mulai')
                ->label('Tanggal Mulai')
                ->required()
                ->native(false)
                ->displayFormat('d M Y')
                ->prefixIcon('heroicon-o-calendar')
                ->closeOnDateSelection(),
                    
                Forms\Components\DatePicker::make('tgl_selesai')
                    ->label('Tanggal Selesai')
                    ->native(false)
                    ->displayFormat('d M Y')
                    ->prefix('Selesai:')
                    ->rules([
                        'after_or_equal:tgl_mulai'
                    ]),
                    
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif?')
                    ->inline(false),
                    
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->default(0)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kegiatan')
                ->searchable(),
                
                Tables\Columns\TextColumn::make('tgl_mulai')
                    ->label('Tanggal Mulai')
                    ->date('d M Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('tgl_selesai')
                    ->label('Tanggal Selesai')
                    ->date('d M Y'),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status'),
                    
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
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
            'index' => Pages\ManagePenjadwalans::route('/'),
        ];
    }
}