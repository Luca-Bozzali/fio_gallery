document.querySelectorAll(".year-section").forEach(section => {

    const track = section.querySelector("[data-slider]");
    const next = section.querySelector("[data-next]");
    const prev = section.querySelector("[data-prev]");

    const images = track.querySelectorAll("img");

    const visibleImages = 4;

    let currentIndex = 0;

    updateButtons();

    function updateButtons(){

    prev.disabled = currentIndex === 0;

    next.disabled = currentIndex >= images.length - visibleImages;

}



    function updateSlider() {

        const imageWidth = images[0].offsetWidth;

        const gap = 20;

        const distance = currentIndex * (imageWidth + gap);

        track.style.transform = `translateX(-${distance}px)`;
        updateButtons();

    }

    next.addEventListener("click", () => {
        if(currentIndex < images.length - visibleImages){

            currentIndex++;

            updateSlider();

        }

    });

    prev.addEventListener("click", () => {

        if(currentIndex > 0){

            currentIndex--;

            updateSlider();

        }

    });

});