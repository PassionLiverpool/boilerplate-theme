document.addEventListener('DOMContentLoaded', () => {

  // Initialize Swiper for image gallery
  document.querySelectorAll('.image-gallery-swiper').forEach((el) => {
    new Swiper(el, {
      slidesPerView: 3.2,
      spaceBetween: 24,
      pagination: {
        el: el.querySelector('.swiper-pagination'),
        clickable: true,
      },
        breakpoints: {
        0: {        // from 0px up
          slidesPerView: 1.2,
        },
        768: {      // from 768px up
          slidesPerView: 3.2,
        }
      }
    });
  });

  // Initialize Swiper for video gallery
  document.querySelectorAll('.video-gallery-swiper').forEach((el) => {
    new Swiper(el, {
      slidesPerView: 3.2,
      spaceBetween: 24,
      pagination: {
        el: el.querySelector('.swiper-pagination'),
        clickable: true,
      },
        breakpoints: {
        0: {        // from 0px up
          slidesPerView: 1.2,
        },
        900: {      // from 768px up
          slidesPerView: 3.2,
        }
      }
    });
  });
});
