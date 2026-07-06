<?php

namespace App\Filament\Resources\Albums\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    // Opzionale: permette di identificare il record in alcune UI (es. titoli, global search)
    protected static ?string $recordTitleAttribute = 'title';

    /**
     * Form di creazione/modifica per Photo.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('filepath')
                    ->label('Foto')
                    ->image()
                    ->imageEditor() // consente di editare/croppare l'immagine
                    ->disk('public')
                    ->directory(fn() => 'albums/' . $this->getOwnerRecord()->id) 
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

    /**
     * Tabella relazione Photo.
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->size(70),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titolo')
                    ->searchable()
                    ->placeholder('Nessun titolo'),
                Tables\Columns\TextColumn::make('alt_text')
                    ->label('Alt text')
                    ->placeholder('-'),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Pubblicata')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->recordActions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
