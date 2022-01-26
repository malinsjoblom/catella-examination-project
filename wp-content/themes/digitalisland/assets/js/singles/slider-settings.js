// Swiper settings for .di-slider
import Swiper, { Navigation } from 'swiper';
Swiper.use([Navigation]); // docs: https://swiperjs.com/api/

var swiperInstances = [];
document.addEventListener("DOMContentLoaded", function () {
  var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
  var diPostSlider = {
    sliderPerView: "auto",
    slidesOffsetBefore: 0,
    slidesOffsetAfter: 0,
    spaceBetween: 30,
    width: vw - 100,
    loop: true,
  loopAdditionalSlides: 8,
    breakpoints: {
      500: {
        width: 256
      }
    },
    observer: true,
    observeParents: true,
    navigation: {
      prevEl: '.swiper-buttons__button--prev',
      nextEl: '.swiper-buttons__button--next',
      disabledClass: 'swiper-buttons__button--disabled'
    }
  };
  document.querySelectorAll('.di-slider').forEach(function (element, i) {
    swiperInstances[i] = new Swiper(element, diPostSlider);
  });
});