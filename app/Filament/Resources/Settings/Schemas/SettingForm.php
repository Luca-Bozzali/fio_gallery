<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('photographer_name')
                    ->label('Nome fotografo')
                    ->required(),

                TextInput::make('email')
                    ->label('Indirizzo email')
                    ->email()
                    ->required(),

                TextInput::make('instagram_url')
                    ->url(),

                TextInput::make('vimeo_url')
                    ->url()
                    ->placeholder('https://vimeo.com/...'),

                TextInput::make('location')
                    ->label('Posizione')
                    ->columnSpanFull(),

                Textarea::make('bio')
                    ->rows(10)
                    ->columnSpanFull(),

                FileUpload::make('profile_image')
                    ->label('Immagine profilo')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }
}