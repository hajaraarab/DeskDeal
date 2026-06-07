import Swiper from 'swiper';
import 'swiper/css';

const selector = document.querySelector('.related-products-swiper');

if (selector) {
	new Swiper(selector, {
		slidesPerView: 4,
		spaceBetween: 20,
		breakpoints: {
			0: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			},
			1024: {
				slidesPerView: 4,
			},
		},
	});
}

// Initialize Swiper for user products carousel without removing the other one
const userSelector = document.querySelector('.user-products-swiper');

if (userSelector) {
    new Swiper(userSelector, {
        slidesPerView: 4,
        spaceBetween: 20,
        breakpoints: {
            0: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            1024: { slidesPerView: 4 },
        },
    });
}