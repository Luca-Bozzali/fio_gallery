<x-layout>
    @php
        $photos = [
            ['image' => 'prova_1.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_2.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_3.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_6.JPG', 'alt' => 'Fotografia orizzontale del portfolio'],
            ['image' => 'prova_4.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_5.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_7.jpg', 'alt' => 'Fotografia orizzontale del portfolio'],
               ['image' => 'prova_1.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_2.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_3.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_6.JPG', 'alt' => 'Fotografia orizzontale del portfolio'],
            ['image' => 'prova_4.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_5.jpg', 'alt' => 'Fotografia verticale del portfolio'],
            ['image' => 'prova_7.jpg', 'alt' => 'Fotografia orizzontale del portfolio'],
        ];
    @endphp

    <x-home-grid>
        @foreach ($photos as $photo)
            <x-home-photo :photo="$photo" :index="$loop->index" />
        @endforeach
    </x-home-grid>
</x-layout>
