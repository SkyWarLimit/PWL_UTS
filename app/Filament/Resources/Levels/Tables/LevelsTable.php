<?php

namespace App\Filament\Resources\Levels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class LevelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Kolom Kode Level (Dibuat Tebal)
                TextColumn::make('level_kode')
                    ->label('Kode Level')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(), // Memudahkan admin menyalin kode level

                // 2. Kolom Nama Level
                TextColumn::make('level_nama')
                    ->label('Nama Level')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
