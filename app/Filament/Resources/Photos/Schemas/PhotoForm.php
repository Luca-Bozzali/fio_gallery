<?php

namespace App\Filament\Resources\Photos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('filepath')
                    ->label('Foto')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('albums')
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
}