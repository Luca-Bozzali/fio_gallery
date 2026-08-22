<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    public function homepage()
    {
        if (! Schema::hasTable('photos') || ! Schema::hasTable('albums')) {
            return view('homepage', [
                'homepagePhotos' => collect(),
            ]);
        }

        $homepagePhotos = Photo::query()
            ->with('album')
            ->where('is_homepage', true)
            ->where('is_published', true)
            ->whereHas('album', fn ($query) => $query->where('is_published', true))
            ->orderBy('homepage_order')
            ->orderBy('id')
            ->get();

        return view('homepage', [
            'homepagePhotos' => $homepagePhotos,
        ]);
    }

    public function work()
    {
        return view('work');
    }

    public function personal()
    {
        return view('personal');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
