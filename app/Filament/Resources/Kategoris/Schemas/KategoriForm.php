<?php

namespace App\Filament\Resources\Kategoris\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section untuk membungkus form kategori
                Section::make('Informasi Kategori Barang')
                    ->description('Kelola pengelompokan barang berdasarkan kode dan nama kategori.')
                    ->schema([
                        // Menggunakan Group untuk pengelompokan internal
                        Group::make([])
                            ->schema([
                            TextInput::make('kategori_nama')
                                ->label('Nama Kategori')
                                ->placeholder('Contoh: Elektronik / Pakaian')
                                ->required()
                                ->maxLength(150),

                            TextInput::make('kategori_kode')
                                ->label('Kode Kategori')
                                ->placeholder('Contoh: KTG')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(10),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }
}