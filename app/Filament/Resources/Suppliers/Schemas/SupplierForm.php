<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Menggunakan Section untuk membingkai form supplier
                Section::make('Informasi Mitra Supplier')
                    ->description('Lengkapi data identitas dan alamat operasional supplier.')
                    ->schema([
                        // Menggunakan Group agar susunan field lebih terorganisir secara internal
                        Group::make(['supplier_kode', 'supplier_nama', 'supplier_alamat'])
                            ->schema([
                            TextInput::make('supplier_nama')
                                ->label('Nama Supplier')
                                ->placeholder('Masukkan nama distributor')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('supplier_kode')
                                ->label('Kode Supplier')
                                ->placeholder('Contoh: SUP')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(10),


                             // Memberikan ruang lebih untuk alamat
                            ])->columns(2),
                            Textarea::make('supplier_alamat')
                                ->label('Alamat Lengkap')
                                ->placeholder('Masukkan alamat supplier')
                                ->required()
                                ->rows(3),
                    ])->columnSpanFull(),
            ]);
    }
}