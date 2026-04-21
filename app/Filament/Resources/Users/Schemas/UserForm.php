<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Hash;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Column;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Pengguna')
                    ->description('Informasi tentang pengguna')
                    ->schema([
                // Group 1: Identitas Dasar (Nama dan Username)
                Group::make([
                    TextInput::make('nama')
                        ->label('Nama Lengkap')
                        ->placeholder('Masukkan nama lengkap')
                        ->required()
                        ->maxLength(255),
                    
                    TextInput::make('username')
                        ->label('Username')
                        ->placeholder('Contoh: Devan123')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(20),
                    Select::make('level_id')
                        ->label('Level Pengguna')
                        ->relationship('level', 'level_nama') // Pastikan relasi 'level' ada di Model User
                        ->required()
                        ->searchable()
                        ->preload(),

                    TextInput::make('email')
                        ->label('Alamat Email')
                        ->placeholder('contoh@email.com')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true),
                    TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->revealable()
                        ->required(fn (string $context): bool => $context === 'create'),
                    
                ])->columns(2),
                    ])->columnSpanFull(),
                
            ]);
    }
}