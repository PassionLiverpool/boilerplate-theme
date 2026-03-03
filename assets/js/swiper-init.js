document.addEventListener('DOMContentLoaded', () => {
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
});