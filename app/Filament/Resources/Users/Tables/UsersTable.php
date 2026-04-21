<?php

namespace App\Filament\Resources\Users\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('username')
                    ->label('Username')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('level.level_nama')
                    ->label('Level')
                    ->badge()
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                    
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
