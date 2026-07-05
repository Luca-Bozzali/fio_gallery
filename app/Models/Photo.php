<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
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
        static::creating(function (Photo $photo) {
            if ($photo->filepath && empty($photo->filename)) {
                $photo->filename = basename($photo->filepath);
            }
        });
        
        static::deleting(function (Photo $photo) {
    if ($photo->filepath) {
        Storage::disk('public')->delete($photo->filepath);
    }
});
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}