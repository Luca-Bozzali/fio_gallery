<?php

namespace App\Filament\Resources\Albums\RelationManagers;

use App\Filament\Resources\Photos\Schemas\PhotoForm;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    public function form(Schema $schema): Schema
    {
        return PhotoForm::configure($schema);
    }

    public function table(Table $table): Table
{
    return $table
        ->recordTitleAttribute('title')
        ->columns([
            Tables\Columns\ImageColumn::make('filepath')
                ->label('Foto')
                ->disk('public')
                ->square(),

            Tables\Columns\TextColumn::make('title')
                ->label('Titolo')
                ->searchable(),

            Tables\Columns\IconColumn::make('is_published')
                ->label('Pubblicata')
                ->boolean(),
        ])
        ->headerActions([
            CreateAction::make(),
        ])
        ->recordActions([
            EditAction::make(),
            DeleteAction::make(),
        ]);
}
}