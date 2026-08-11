<x-layout>
    <div class="photo-sections">
        <div class="photo-composition">
            <div class="cell big"><img class="lightbox-trigger" src="{{ asset('images/prova_1.jpg') }}" alt=""></div>
            <div class="cell v1"><img class="lightbox-trigger" src="{{ asset('images/prova_2.jpg') }}" alt=""></div>
            <div class="cell v2"><img class="lightbox-trigger" src="{{ asset('images/prova_3.jpg') }}" alt=""></div>
            <div class="cell v3"><img class="lightbox-trigger" src="{{ asset('images/prova_4.jpg') }}" alt=""></div>
            <div class="cell v4"><img class="lightbox-trigger" src="{{ asset('images/prova_5.jpg') }}" alt=""></div>
            <div class="cell v5"><img class="lightbox-trigger" src="{{ asset('images/prova_2.jpg') }}" alt=""></div>
            <div class="cell v6"><img class="lightbox-trigger" src="{{ asset('images/prova_3.jpg') }}" alt=""></div>
            <div class="cell v7"><img class="lightbox-trigger" src="{{ asset('images/prova_2.jpg') }}" alt=""></div>
            <div class="cell h"><img class="lightbox-trigger" src="{{ asset('images/prova_6.jpg') }}" alt=""></div>
        </div>

        <div class="photo-composition reversed">
            <div class="cell big"><img class="lightbox-trigger" src="{{ asset('images/prova_2.jpg') }}" alt=""></div>
            <div class="cell v1"><img class="lightbox-trigger" src="{{ asset('images/prova_3.jpg') }}" alt=""></div>
            <div class="cell v2"><img class="lightbox-trigger" src="{{ asset('images/prova_4.jpg') }}" alt=""></div>
            <div class="cell v3"><img class="lightbox-trigger" src="{{ asset('images/prova_5.jpg') }}" alt=""></div>
            <div class="cell v4"><img class="lightbox-trigger" src="{{ asset('images/prova_2.jpg') }}" alt=""></div>
            <div class="cell v5"><img class="lightbox-trigger" src="{{ asset('images/prova_4.jpg') }}" alt=""></div>
            <div class="cell v6"><img class="lightbox-trigger" src="{{ asset('images/prova_1.jpg') }}" alt=""></div>
             <div class="cell v7"><img class="lightbox-trigger" src="{{ asset('images/prova_3.jpg') }}" alt=""></div>
            <div class="cell h"><img class="lightbox-trigger" src="{{ asset('images/prova_7.jpg') }}" alt=""></div>
        </div>
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