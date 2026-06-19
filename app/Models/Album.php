<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'featured',
        'is_published',
        'sort_order',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}