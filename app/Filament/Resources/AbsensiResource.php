<?php

namespace App\Filament\Resources;

use App\Exports\PenilaianExport;
use App\Filament\Resources\AbsensiResource\Pages;
use App\Filament\Resources\AbsensiResource\RelationManagers;
use App\Models\Absensi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    public static function getPluralLabel(): string
    {
        return 'Laporan Absensi';
    }

    protected static ?string $navigationGroup = 'Manajemen Kelompok';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Laporan Absensi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama_siswa')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kegiatan')
                    ->label('Kegiatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d F Y')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('catatanPembimbing.catatan')
                    ->label('Catatan Pembimbing')
                    ->searchable()
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->filters([
                Filter::make('tanggal')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Dari Tanggal')
                            ->reactive(),
                        DatePicker::make('created_until')
                            ->label('Sampai Tanggal')
                            ->reactive(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'], fn ($q, $date) => $q->whereDate('tanggal', '>=', $date))
                            ->when($data['created_until'], fn ($q, $date) => $q->whereDate('tanggal', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        $from = $data['created_from'] ?? null;
                        $until = $data['created_until'] ?? null;
            
                        if (!$from && !$until) return null;
            
                        $fromFormatted = $from ? \Carbon\Carbon::parse($from)->format('d M Y') : '...';
                        $untilFormatted = $until ? \Carbon\Carbon::parse($until)->format('d M Y') : '...';
            
                        return "Tanggal: {$fromFormatted} - {$untilFormatted}";
                    }),

                Filter::make('siswa_filter')
                    ->form([
                        Forms\Components\Select::make('siswa_id')
                            ->label('Filter Siswa')
                            ->options(\App\Models\Siswa::pluck('nama_siswa', 'id'))
                            ->searchable()
                            ->placeholder('Pilih Siswa')
                            ->reactive(),
                    ])
                    ->query(fn (Builder $query, array $data): Builder =>
                        $query->when($data['siswa_id'], fn ($q, $val) => $q->where('siswa_id', $val))
                    )
                    ->indicateUsing(fn (array $data): ?string =>
                        isset($data['siswa_id'])
                            ? 'Siswa: ' . \App\Models\Siswa::find($data['siswa_id'])?->nama_siswa
                            : null
                    ),

                Filter::make('kelompok_filter')
                    ->form([
                        Forms\Components\Select::make('kelompok_id')
                            ->label('Filter Kelompok')
                            ->options(\App\Models\Kelompok::pluck('nama_kelompok', 'id'))
                            ->searchable()
                            ->placeholder('Pilih Kelompok')
                            ->reactive(),
                    ])
                    ->query(fn (Builder $query, array $data): Builder =>
                        $query->when($data['kelompok_id'], fn ($q, $val) => $q->where('kelompok_id', $val))
                    )
                    ->indicateUsing(fn (array $data): ?string =>
                        isset($data['kelompok_id'])
                            ? 'Kelompok: ' . \App\Models\Kelompok::find($data['kelompok_id'])?->nama_kelompok
                            : null
                    ),

                Filter::make('pembimbing_filter')
                    ->form([
                        Forms\Components\Select::make('pembimbing_id')
                            ->label('Filter Pembimbing')
                            ->options(\App\Models\Pembimbing::pluck('nama_pembimbing', 'id'))
                            ->searchable()
                            ->placeholder('Pilih Pembimbing')
                            ->reactive(),
                    ])
                    ->query(fn (Builder $query, array $data): Builder =>
                        $query->when($data['pembimbing_id'], fn ($q, $val) => $q->where('pembimbing_id', $val))
                    )
                    ->indicateUsing(fn (array $data): ?string =>
                        isset($data['pembimbing_id'])
                            ? 'Pembimbing: ' . \App\Models\Pembimbing::find($data['pembimbing_id'])?->nama_pembimbing
                            : null
                    ),
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
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
