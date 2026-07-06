<?php

namespace App\Filament\Resources\Albums\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
        return $schema
            ->components([
                FileUpload::make('filepath')
                    ->label('Foto')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory(fn (): string => 'albums/' . $this->getOwnerRecord()->id)
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Titolo'),

                Textarea::make('description')
                    ->label('Descrizione'),

                TextInput::make('alt_text')
                    ->label('Testo alternativo'),

                Toggle::make('is_published')
                    ->label('Pubblicata')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image_url')
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
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
