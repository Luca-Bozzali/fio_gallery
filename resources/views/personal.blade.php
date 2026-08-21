<x-layout title="Personal">
    @php
        $albums = [
            ['slug' => 'Gem', 'title' => 'Gem', 'detail' => '2026', 'image' => 'prova_1.jpg'],
            ['slug' => 'Mad', 'title' => 'Mad', 'detail' => '2026', 'image' => 'prova_2.jpg'],
            ['slug' => 'cazzo', 'title' => 'cazzo', 'detail' => '2025', 'image' => 'prova_3.jpg'],
            ['slug' => 'elsewhere', 'title' => 'Elsewhere', 'detail' => '2025', 'image' => 'prova_4.jpg'],
            ['slug' => 'culo', 'title' => 'culo', 'detail' => '2025', 'image' => 'prova_5.jpg'],
            ['slug' => 'foto', 'title' => 'foto', 'detail' => '2024', 'image' => 'prova_6.JPG'],
            ['slug' => 'aa', 'title' => 'aa', 'detail' => '2024', 'image' => 'prova_7.jpg'],
            ['slug' => 'bb', 'title' => 'bb', 'detail' => 'Personal project', 'image' => 'prova_3.jpg'],
        ];
    @endphp

    <section class="personal-page">
        <div class="content-wrapper">
            <header class="personal-header">
                <h1>PERSONAL</h1>
                <p>My personal projects</p>
            </header>

            <div id="personal-projects" class="personal-grid">
                @foreach ($albums as $album)
                    <article id="{{ $album['slug'] }}" class="personal-album">
                        <a href="#{{ $album['slug'] }}" class="personal-album-link">
                            <div class="personal-album-image">
                                <img
                                    src="{{ asset('images/' . $album['image']) }}"
                                    alt="{{ $album['title'] }} — personal photography project"
                                >
                            </div>

                            <div class="personal-album-info">
                                <h2>{{ $album['title'] }}</h2>
                                <span>{{ $album['detail'] }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
