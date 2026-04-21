<?php

namespace App\Filament\Resources\Barangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan foto barang
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                // Menampilkan kode dan nama barang
                TextColumn::make('barang_nama')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('barang_kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),


                // Menampilkan nama kategori dari relasi
                TextColumn::make('kategori.kategori_nama')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),

                // Menampilkan harga dengan format IDR
                TextColumn::make('harga_jual')
                    ->label('Harga Jual')
                    ->money('IDR')
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
