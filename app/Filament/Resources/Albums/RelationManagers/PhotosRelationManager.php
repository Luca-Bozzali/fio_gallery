<?php

namespace App\Filament\Resources\Albums\RelationManagers;

use App\Filament\Resources\Photos\Schemas\PhotoForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    public function form(Schema $schema): Schema
    {
        return PhotoForm::configure(
            $schema,
            fn (): string => 'albums/'.$this->getOwnerRecord()->getKey(),
        );
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('filepath')
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->size(70),

                TextColumn::make('title')
                    ->label('Titolo')
                    ->searchable()
                    ->placeholder('Nessun titolo'),

                TextColumn::make('alt_text')
                    ->label('Alt text')
                    ->placeholder('-'),

                IconColumn::make('is_published')
                    ->label('Pubblicata')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
