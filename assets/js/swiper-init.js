document.addEventListener('DOMContentLoaded', () => {

  // Initialize Swiper for image gallery
  document.querySelectorAll('.image-gallery-swiper').forEach((el) => {
    new Swiper(el, {
      slidesPerView: 1.2,
      spaceBetween: 24,
      pagination: {
        el: el.querySelector('.swiper-pagination'),
        clickable: true,
      },
    });
  });

  // Initialize Swiper for video gallery
  document.querySelectorAll('.video-gallery-swiper').forEach((el) => {
    new Swiper(el, {
      slidesPerView: 1.2,
      spaceBetween: 24,
      pagination: {
        el: el.querySelector('.swiper-pagination'),
        clickable: true,
      },
    });
  });
});
