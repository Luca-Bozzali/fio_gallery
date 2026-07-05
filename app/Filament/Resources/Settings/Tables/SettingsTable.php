<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_image')
                    ->label('Foto'),

                TextColumn::make('photographer_name')
                    ->label('Fotografo')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('phone'),

                TextColumn::make('updated_at')
                    ->label('Ultima modifica')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }
}