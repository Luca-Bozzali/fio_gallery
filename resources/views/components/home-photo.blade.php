@props([
    'photo' => null,
    'image' => null,
    'alt' => '',
    'index' => null,
])

@php
    $source = $photo['image'] ?? $image;
    $description = $photo['alt'] ?? $alt;
    $loading = $index !== null && $index < 3 ? 'eager' : 'lazy';
@endphp

@if ($source)
    <figure class="home-collage-item" data-home-photo>
        <img
            src="{{ asset('images/' . $source) }}"
            alt="{{ $description }}"
            class="home-photo"
            loading="{{ $loading }}"
            decoding="async">
    </figure>
@endif
