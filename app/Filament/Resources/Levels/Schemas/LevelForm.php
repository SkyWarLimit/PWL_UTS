<?php

namespace App\Filament\Resources\Levels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class LevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Menggunakan Section untuk memberikan bingkai dan identitas menu
                Section::make('Detail Level Pengguna')
                    ->description('Tentukan kode dan nama untuk level pengguna.')
                    ->schema([
                        // Menggunakan Group untuk mengatur tata letak di dalam Section
                        Group::make(['level_kode', 'level_nama'])
                                ->schema([
                                    TextInput::make('level_kode')
                                        ->label('Kode Level')
                                        ->placeholder('Contoh: ADM / MNG')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(10),

                                    TextInput::make('level_nama')
                                        ->label('Nama Level')
                                        ->placeholder('Contoh: Administrator')
                                        ->required()
                                        ->maxLength(100),
                                ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }
}