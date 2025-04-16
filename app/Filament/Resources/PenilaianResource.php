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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Facades\Excel;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    public static function getPluralLabel(): string
    {
        return 'Kelola Penilaian';
    }

    protected static ?string $navigationGroup = 'Manajemen Kelompok';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'Kelola Penilaian';

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
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelompok.nama_kelompok')
                    ->label('Kelompok')
                    ->searchable(),
                Tables\Columns\TextColumn::make('average_poin')
                    ->label('Rata-rata')
                    ->searchable(),
                Tables\Columns\TextColumn::make('report_poin')
                    ->label('Laporan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kelompok')
                    ->relationship('kelompok', 'nama_kelompok')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('pembimbing')
                    ->relationship('pembimbing', 'nama_pembimbing')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('export')
                        ->label('Export Selected')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function ($records, array $data) {
                            $filters = [];
                            
                            if (request()->has('tableFilters')) {
                                $tableFilters = request()->input('tableFilters');
                                if (isset($tableFilters['kelompok'])) {
                                    $filters['kelompok_id'] = $tableFilters['kelompok'];
                                }
                                if (isset($tableFilters['pembimbing'])) {
                                    $filters['pembimbing_id'] = $tableFilters['pembimbing'];
                                }
                            }
                            
                            return Excel::download(
                                new PenilaianExport([
                                    ...$filters,
                                    'ids' => $records->pluck('id')->toArray()
                                ]), 
                                'penilaian-export.xlsx'
                            );
                        }),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->label('Export Data')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (array $data) {
                        $filters = [];
                        
                        if (request()->has('tableFilters')) {
                            $tableFilters = request()->input('tableFilters');
                            if (isset($tableFilters['kelompok'])) {
                                $filters['kelompok_id'] = $tableFilters['kelompok'];
                            }
                            if (isset($tableFilters['pembimbing'])) {
                                $filters['pembimbing_id'] = $tableFilters['pembimbing'];
                            }
                        }
                        
                        return Excel::download(
                            new PenilaianExport($filters), 
                            'penilaian-export.xlsx'
                        );
                    }),
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