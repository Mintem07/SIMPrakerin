<?php

namespace App\Filament\Resources;

use App\Exports\PenilaianExport;
use App\Filament\Resources\PenilaianResource\Pages;
use App\Filament\Resources\PenilaianResource\RelationManagers;
use App\Models\Penilaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Facades\Excel;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    public static function getPluralLabel(): string
    {
        return 'Laporan Penilaian';
    }

    protected static ?string $navigationGroup = 'Manajemen Kelompok';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Laporan Penilaian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama_siswa')
                    ->label('Nama')
                    ,
                Tables\Columns\TextColumn::make('kelompok.nama_kelompok')
                    ->label('Kelompok')
                    ,
                Tables\Columns\TextColumn::make('average_poin')
                    ->label('Rata-rata')
                    ,
                Tables\Columns\TextColumn::make('report_poin')
                    ->label('Laporan')
                    ,
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'secondary',
                        'Lulus' => 'success',
                        'Tidak Lulus' => 'danger',
                    }),
            ])
            ->recordUrl(null)
            ->filters([
                Tables\Filters\Filter::make('kelompok_filter')
                ->form([
                    Forms\Components\Select::make('kelompok_id')
                        ->label('Filter Kelompok')
                        ->options(\App\Models\Kelompok::pluck('nama_kelompok', 'id'))
                        ->searchable()
                        ->placeholder('Pilih Kelompok')
                        ->reactive(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['kelompok_id'],
                            fn(Builder $query, $kelompokId) => $query->where('kelompok_id', $kelompokId)
                        );
                })
                ->indicator(function (array $data): ?string {
                    if (!isset($data['kelompok_id'])) {
                        return null;
                    }
                    
                    $kelompok = \App\Models\Kelompok::find($data['kelompok_id']);
                    return $kelompok ? 'Kelompok: ' . $kelompok->nama_kelompok : null;
                }),

                Tables\Filters\Filter::make('pembimbing_filter')
                ->form([
                    Forms\Components\Select::make('pembimbing_id')
                        ->label('Filter Pembimbing')
                        ->options(\App\Models\Pembimbing::pluck('nama_pembimbing', 'id'))
                        ->searchable()
                        ->placeholder('Pilih Pembimbing')
                        ->reactive(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['pembimbing_id'],
                            fn(Builder $query, $pembimbingId) => $query->where('pembimbing_id', $pembimbingId)
                        );
                })
                ->indicator(function (array $data): ?string {
                    if (!isset($data['pembimbing_id'])) {
                        return null;
                    }
                    
                    $pembimbing = \App\Models\Pembimbing::find($data['pembimbing_id']);
                    return $pembimbing ? 'Pembimbing: ' . $pembimbing->nama_pembimbing : null;
                }),
            ],  layout: FiltersLayout::AboveContentCollapsible)
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaians::route('/'),
            'create' => Pages\CreatePenilaian::route('/create'),
            'edit' => Pages\EditPenilaian::route('/{record}/edit'),
        ];
    }
}