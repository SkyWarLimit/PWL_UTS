<?php

namespace App\Filament\Resources\Stoks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Tables\Columns\Column;
use Filament\Schemas\Schema;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section untuk membungkus seluruh input stok
                Section::make('Pencatatan Stok Barang')
                    ->description('Input data barang masuk dari supplier beserta petugas penanggung jawab.')
                    ->schema([
                        // Menggunakan Group untuk menyusun field secara vertikal tanpa grid
                        Group::make(['class' => 'space-y-4'])
                            ->schema([
                            // Pilih Barang dari m_barang
                            Select::make('barang_id')
                                ->label('Pilih Barang')
                                ->relationship('barang', 'barang_nama')
                                ->required()
                                ->searchable()
                                ->preload(),
                            
                            // Pilih Supplier dari m_supplier
                            Select::make('supplier_id')
                                ->label('Supplier Pengirim')
                                ->relationship('supplier', 'supplier_nama')
                                ->required()
                                ->searchable()
                                ->preload(),

                            // Pilih Petugas dari m_user
                            Select::make('user_id')
                                ->label('Petugas Penerima (User)')
                                ->relationship('user', 'nama')
                                ->required()
                                ->searchable()
                                ->preload(),

                            // Jumlah stok yang masuk
                            TextInput::make('stok_jumlah')
                                ->label('Jumlah Unit')
                                ->numeric()
                                ->required()
                                ->placeholder('0')
                                ->minValue(1),
                            
                        ])->columns(2),
                        // Tanggal stok masuk
                            DateTimePicker::make('stok_tanggal')
                                ->label('Tanggal & Waktu Masuk')
                                ->required()
                                ->default(now()),
                    ])->columnSpanFull(),
            ]);
    }
}