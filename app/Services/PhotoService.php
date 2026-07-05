<?php

namespace App\Services;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoService
{
    public function upload(Album $album, UploadedFile $file, array $data = []): Photo
    {
        // Nome file univoco
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Cartella dell'album
        $directory = "albums/{$album->id}";

        // Salvataggio
        $path = $file->storeAs($directory, $filename, 'public');

        // Dimensioni immagine
        $imageSize = @getimagesize($file->getRealPath());

        $width = $imageSize[0] ?? null;
        $height = $imageSize[1] ?? null;

        return Photo::create([
            'album_id'      => $album->id,
            'title'         => $data['title'] ?? null,
            'description'   => $data['description'] ?? null,
            'alt_text'      => $data['alt_text'] ?? null,

            'filename'      => $filename,
            'filepath'      => $path,
            'mime_type'     => $file->getMimeType(),
            'filesize'      => $file->getSize(),
            'width'         => $width,
            'height'        => $height,

            'sort_order' => $album->photos()->max('sort_order') + 1,
            'is_published'  => $data['is_published'] ?? true,
        ]);
    }

    public function delete(Photo $photo): void
    {
        Storage::disk('public')->delete($photo->filepath);

        $photo->delete();
    }
}