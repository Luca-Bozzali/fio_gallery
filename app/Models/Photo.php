<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}