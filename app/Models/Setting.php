<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'photographer_name',
        'email',
        'phone',
        'bio',
        'profile_image',
        'instagram_url',
        'facebook_url',
        'website_url',
    ];
}