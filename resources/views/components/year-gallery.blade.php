<section class="year-section">

    <h2 class="year-title">{{ $year }}</h2>

    <div class="gallery-container">

        <button class="gallery-arrow gallery-arrow-left" data-prev>

            <i class="fa-solid fa-circle-left"></i>

        </button>

        <div class="gallery-viewport">

            <div class="gallery-track" id="gallery-{{ $year }}" data-slider>

                {{ $slot }}

            </div>

        </div>

        <button class="gallery-arrow gallery-arrow-right" data-next>

            <i class="fa-solid fa-circle-right"></i>

        </button>

    </div>

</section>