<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = [

            // Portfolio

            ['title' => 'Islanda', 'year' => 2026, 'type' => 'portfolio'],
            ['title' => 'Dolomiti', 'year' => 2026, 'type' => 'portfolio'],
            ['title' => 'Maspalomas', 'year' => 2025, 'type' => 'portfolio'],
            ['title' => 'Street Photography', 'year' => 2025, 'type' => 'portfolio'],
            ['title' => 'Tenerife', 'year' => 2024, 'type' => 'portfolio'],
            ['title' => 'Madrid', 'year' => 2024, 'type' => 'portfolio'],

            // Clienti

            ['title' => 'Matrimonio Luca e Sara', 'year' => 2026, 'type' => 'client'],
            ['title' => 'Villa Rossi', 'year' => 2026, 'type' => 'client'],
            ['title' => 'Casa Bianchi', 'year' => 2025, 'type' => 'client'],
            ['title' => 'Shooting Giulia', 'year' => 2025, 'type' => 'client'],
        ];

        foreach ($albums as $album) {

            Album::updateOrCreate(
                [
                    'title' => $album['title'],
                ],
                $album
            );

        }
    }
}