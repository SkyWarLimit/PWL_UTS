<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\View;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penjualan_kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('pembeli')
                    ->label('Pelanggan')
                    ->searchable(),

                TextColumn::make('user.nama')
                    ->label('Kasir'),

                TextColumn::make('penjualan_tanggal')
                    ->label('Waktu')
                    ->dateTime('d/m/y H:i'),

                // Menghitung Total Harga per Transaksi secara dinamis
                TextColumn::make('total_harga')
                    ->label('Total Bayar')
                    ->money('IDR')
                    ->state(function ($record) {
                        return $record->details->sum(fn ($detail) => $detail->harga * $detail->jumlah);
                    }),
            ])
                
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat Detail')
                    ->modalContent(fn ($record) => View('filament.resources.penjualan.view', ['record' => $record]))
                    ->form([])
                    ->modalSubmitAction(false),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
