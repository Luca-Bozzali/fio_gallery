<x-layout>
    <div class="photo-sections">
        @php
            $cellClasses = ['big', 'v1', 'v2', 'v3', 'v4', 'v5', 'v6', 'v7', 'h'];
        @endphp

        @foreach ($homepagePhotos->chunk(9)->values() as $sectionIndex => $photos)
            <div class="photo-composition {{ $sectionIndex % 2 === 1 ? 'reversed' : '' }}">
                @foreach ($photos->values() as $index => $photo)
                    <div class="cell {{ $cellClasses[$index] ?? 'v1' }}">
                        <img
                            class="lightbox-trigger"
                            src="{{ $photo->image_url }}"
                            alt="{{ $photo->filename }}"
                        >
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="lightbox" id="lightbox">

    <button class="lightbox-close">

        &times;

    </button>

    <button class="lightbox-prev">

        &#10094;

    </button>

    <img
        class="lightbox-image"
        src=""
        alt=""
    >

    <button class="lightbox-next">

        &#10095;

    </button>

</div>
</x-layout>
