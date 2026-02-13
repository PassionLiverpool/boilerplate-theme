document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.image-gallery-swiper').forEach((el) => {
    new Swiper(el, {
      slidesPerView: 1.2,
      loop: true,
      speed: 600,
      spaceBetween: 24,
      pagination: {
        el: el.querySelector('.swiper-pagination'),
        clickable: true,
      },
      navigation: {
        nextEl: el.querySelector('.swiper-button-next'),
        prevEl: el.querySelector('.swiper-button-prev'),
      },
    });
  });
});