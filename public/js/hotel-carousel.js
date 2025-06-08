document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.getElementById("hotelCarousel");
    if (!carousel) return;

    const items = carousel.querySelectorAll(".carousel-item");
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");
    const thumbnails = document.querySelectorAll(".thumbnail-btn");
    let currentIndex = 0;

    function showSlide(index) {
        items.forEach((item, i) => {
            item.style.opacity = i === index ? "1" : "0";
        });

        thumbnails.forEach((thumb, i) => {
            thumb.classList.toggle("border-blue-500", i === index);
            thumb.classList.toggle("border-transparent", i !== index);
        });

        currentIndex = index;
    }

    function nextSlide() {
        showSlide((currentIndex + 1) % items.length);
    }

    function prevSlide() {
        showSlide((currentIndex - 1 + items.length) % items.length);
    }

    // Event Listeners
    if (nextButton) nextButton.addEventListener("click", nextSlide);
    if (prevButton) prevButton.addEventListener("click", prevSlide);

    thumbnails.forEach((thumb, index) => {
        thumb.addEventListener("click", () => showSlide(index));
    });

    // Auto-advance slides every 5 seconds
    setInterval(nextSlide, 5000);
});
