<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Enums\AlbumType;

class Album extends Model
{
    protected $fillable = [
        'title',
        'year',
        'type',
        'slug',
        'description',
        'featured',
        'is_published',
        'sort_order',
    ];

    /**
     * Eventi del Model.
     */
    protected static function booted(): void
    {
        static::creating(function (Album $album) {

            if (empty($album->slug)) {
                $album->slug = Str::slug($album->title);
            }

        });

        static::updating(function (Album $album) {

            if ($album->isDirty('title')) {
                $album->slug = Str::slug($album->title);
            }

        });
    }

    /**
     * Un album contiene molte foto.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    protected function casts(): array
{
    return [
        'featured' => 'boolean',
        'is_published' => 'boolean',
        'type' => AlbumType::class,
    ];
}
}

