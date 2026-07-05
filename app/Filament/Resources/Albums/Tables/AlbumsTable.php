<?php

namespace App\Filament\Resources\Albums\Tables;

use App\Enums\AlbumType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlbumsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titolo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('year')
                    ->label('Anno')
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (AlbumType $state) => $state->label()),

                IconColumn::make('featured')
                    ->label('Homepage')
                    ->boolean(),

                IconColumn::make('is_published')
                    ->label('Pubblicato')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Ultima modifica')
                    ->since()
                    ->sortable(),
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