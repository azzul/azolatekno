document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".slide-hero");
    const prevBtn = document.querySelector(".prev-hero");
    const nextBtn = document.querySelector(".next-hero");
    const dotsContainer = document.getElementById("dotsHero");

    let currentSlide = 0;
    let autoSlideInterval;

    // Buat dots
    slides.forEach((_, index) => {
      const dot = document.createElement("span");
      dot.classList.add("dot-hero");
      if (index === 0) dot.classList.add("active");
      dot.addEventListener("click", () => goToSlide(index));
      dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll(".dot-hero");

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.remove("active");
        dots[i].classList.remove("active");
        if (i === index) {
          slide.classList.add("active");
          dots[i].classList.add("active");
        }
      });
      currentSlide = index;
    }

    function nextSlide() {
      let next = (currentSlide + 1) % slides.length;
      showSlide(next);
    }

    function prevSlide() {
      let prev = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(prev);
    }

    function goToSlide(index) {
      showSlide(index);
      resetInterval();
    }

    function startAutoSlide() {
      autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function resetInterval() {
      clearInterval(autoSlideInterval);
      startAutoSlide();
    }

    prevBtn.addEventListener("click", () => {
      prevSlide();
      resetInterval();
    });

    nextBtn.addEventListener("click", () => {
      nextSlide();
      resetInterval();
    });

    // Inisialisasi
    showSlide(currentSlide);
    startAutoSlide();
  });