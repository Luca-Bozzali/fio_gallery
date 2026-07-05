<?php

namespace App\Enums;

enum AlbumType: string
{
    case Portfolio = 'portfolio';
    case Services = 'services';

    public function label(): string
    {
        return match ($this) {
            self::Portfolio => 'Portfolio',
            self::Services => 'Servizi',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $type) => [
                $type->value => $type->label(),
            ])
            ->toArray();
    }
}