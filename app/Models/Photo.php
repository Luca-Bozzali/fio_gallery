<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $appends = ['image_url'];

    protected $fillable = [
        'album_id',
        'title',
        'description',
        'filename',
        'filepath',
        'mime_type',
        'filesize',
        'width',
        'height',
        'alt_text',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Photo $photo) {
            if ($photo->filepath && ($photo->isDirty('filepath') || empty($photo->filename))) {
                $photo->filename = basename($photo->filepath);
            }
        });

        static::deleting(function (Photo $photo) {
            // Cancella il file associato al percorso salvato.
            if ($photo->filepath) {
                Storage::disk('public')->delete($photo->filepath);
            }
        });

        static::updating(function (Photo $photo) {
            // Se la foto e' stata cambiata, elimina il vecchio file.
            if ($photo->isDirty('filepath')) {
                $old = $photo->getOriginal('filepath');

                if ($old) {
                    Storage::disk('public')->delete($old);
                }
            }
        });
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->filepath
            ? Storage::disk('public')->url($this->filepath)
            : null;
    }
}
