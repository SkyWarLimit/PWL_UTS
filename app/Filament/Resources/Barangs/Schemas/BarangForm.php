<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Informasi & Media (Kiri: Teks, Kanan: Foto)
                    Step::make('Informasi Barang')
                        ->description('Lengkapi identitas barang.')
                        ->schema([
                            // Menggunakan Group dengan columns(2) sebagai pengganti Grid
                            Group::make([
                                // Group Kiri: Nama, Kategori, Kode (Otomatis menumpuk ke bawah)
                                Group::make([
                                    TextInput::make('barang_nama')
                                        ->label('Nama Barang')
                                        ->placeholder('Masukkan nama barang')
                                        ->required(),
                                    
                                    Select::make('kategori_id')
                                        ->label('Kategori Barang')
                                        ->relationship('kategori', 'kategori_nama')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->native(false),

                                    TextInput::make('barang_kode')
                                        ->label('Kode Barang')
                                        ->placeholder('Contoh: BRG')
                                        ->required()
                                        ->unique(table: 'm_barang', column: 'barang_kode', ignoreRecord: true),
                                ])->columnSpan(1),

                                // Group Kanan: Foto Produk
                                Group::make([
                                    FileUpload::make('image')
                                        ->label('Foto Produk')
                                        ->image()
                                        ->directory('barangs')
                                        ->disk('public')
                                        ->required(),
                                ])->columnSpan(1),
                            ])->columns(2), // Mengatur pembagian 2 kolom pada Group utama
                        ]),

                    // Step 2: Finansial (Harga Beli & Jual)
                    Step::make('Harga Barang')
                        ->description('Tentukan harga beli dan harga jual barang.')
                        ->schema([
                            // Menggunakan Group columns(2) agar harga sejajar ke samping
                            Group::make([
                                TextInput::make('harga_beli')
                                    ->label('Harga Beli')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),

                                TextInput::make('harga_jual')
                                    ->label('Harga Jual')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                            ])->columns(2),
                        ]),
                ])->columnSpanFull()
                  ->submitAction(
                    Action::make('submit')
                        ->label('Simpan Barang')
                        ->button()
                        ->color('primary')
                        ->submit('save')
                  ),
            ]);
    }
}