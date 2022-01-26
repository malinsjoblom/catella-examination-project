// Swiper settings for .di-slider

// docs: https://swiperjs.com/api/
import  { Swiper, Navigation } from 'swiper';
Swiper.use([Navigation])


window.swiperInstances = window.swiperInstances || [];

window.addEventListener('load', function () {
	let vw = Math.max(document.documentElement.clientWidth, window.innerWidth)
	const mainContainer = document.getElementById('site-main')
	const getContainerOffset = (element = mainContainer) => (vw - element.clientWidth) / 2;

	document.querySelectorAll('.di-slider').forEach(function (element, i) {
		const diPostSlider = {
			slidesPerView: 1,
			// centeredSlides: true,
			spaceBetween: 0,
			width: null,
			speed: 100,
            setWrapperSize: true,
			watchSlidesProgress: true,
			watchSlidesVisibility: true,
			slidesOffsetBefore: 0,
			slidesOffsetAfter: 0,
			loop: true,
            loopAdditionalSlides: 8,
			// preventInteractionOnTransition: true,,

			observer: true,
			observeParents: true,
			observeSlideChildren: true,

			wrapperClass: 'swiper-wrapper',
			navigation: {
				prevEl: '.swiper-buttons__button--prev',
				nextEl: '.swiper-buttons__button--next',
				disabledClass: 'swiper-buttons__button--disabled',
			},
			breakpoints: {
            1024: {
            slidesPerView:4,
            spaceBetween: 0,
           },
            768: {
            slidesPerView: 1,
            spaceBetween: 0,
          },
            
        },
			on: {
				resize() {
					const swiper = this;
					swiper.slidesOffsetBefore = getContainerOffset();
					swiper.slidesOffsetAfter = getContainerOffset();
				}
			}
		};

		const swiperInstance = new Swiper(element, diPostSlider);
		swiperInstances[i] = swiperInstance;
	});
})
