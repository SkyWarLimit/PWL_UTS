<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Actions\Action;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Data Header Transaksi
                    Step::make('Informasi Transaksi')
                        ->description('Lengkapi data utama penjualan.')
                        ->schema([
                            Section::make('Header Penjualan')
                                ->schema([
                                    Group::make([
                                        TextInput::make('penjualan_kode')
                                            ->label('Kode Penjualan')
                                            ->default('PJN-' . date('YmdHis'))
                                            ->required()
                                            ->unique(ignoreRecord: true),

                                        DateTimePicker::make('penjualan_tanggal')
                                            ->label('Tanggal Transaksi')
                                            ->required()
                                            ->default(now()),

                                        TextInput::make('pembeli')
                                            ->label('Nama Pembeli')
                                            ->placeholder('Nama pelanggan')
                                            ->required(),

                                        Select::make('user_id')
                                            ->label('Kasir (Petugas)')
                                            ->relationship('user', 'nama')
                                            ->required()
                                            ->searchable()
                                            ->preload(),

                                    ]),
                                ]),
                        ]),

                    // Step 2: Data Detail Barang (Menggunakan Repeater)
                    Step::make('Daftar Belanja')
                        ->description('Tambahkan barang yang dibeli.')
                        ->schema([
                            Section::make('Item Penjualan')
                                ->schema([
                                    // Repeater untuk menangani t_penjualan_detail
                                    Repeater::make('details')
                                        ->relationship() // Mengacu pada relasi hasMany di Model Penjualan
                                        ->schema([
                                            Select::make('barang_id')
                                                ->label('Pilih Barang')
                                                ->relationship('barang', 'barang_nama')
                                                ->required()
                                                ->searchable()
                                                ->preload()
                                                // Logika otomatis mengisi harga saat barang dipilih (opsional)
                                                ->reactive()
                                                ->afterStateUpdated(function ($state, $set) {
                                                        // Cari data barang berdasarkan ID yang dipilih
                                                        $barang = \App\Models\Barang::find($state);
                                                        // Jika barang ditemukan, ambil harganya. Jika tidak, set ke 0.
                                                        $harga = $barang ? $barang->harga_jual : 0;
                                                        // Masukkan nilainya ke field 'harga'
                                                        $set('harga', $harga);
                                                        }),

                                            TextInput::make('harga')
                                                ->label('Harga Satuan')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->required()
                                                ->readOnly()
                                                ->dehydrated(true),

                                            TextInput::make('jumlah')
                                                ->label('Jumlah Beli')
                                                ->numeric()
                                                ->default(1)
                                                ->required()
                                                ->minValue(1),
                                        ])
                                        ->columns(3) // Menyusun input di dalam repeater secara horizontal
                                        ->itemLabel(fn (array $state): ?string => 
                                            \App\Models\Barang::find($state['barang_id'])?->barang_nama ?? 'Item Baru'
                                        ),
                                ]),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}