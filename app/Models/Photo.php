<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{

    protected function casts(): array
{
    return [
        'is_published' => 'boolean',
    ];
}
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

    protected static function booted(): void
{
    static::deleting(function (Photo $photo) {
        // Cancella il file associato al percorso salvato
        if ($photo->filepath) {
            Storage::disk('public')->delete($photo->filepath);
        }
    });

    static::updating(function (Photo $photo) {
        // Se la foto è stata cambiata, elimina il vecchio file
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