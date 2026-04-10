import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.body.classList.add('js-ready');

const header = document.querySelector('.layout-header');

if (header) {
	const syncHeaderState = () => {
		const isScrolled = window.scrollY > 8;
		header.classList.toggle('is-scrolled', isScrolled);
		header.classList.toggle('is-at-top', !isScrolled);
	};

	syncHeaderState();
	window.addEventListener('scroll', syncHeaderState, { passive: true });
}

const revealItems = document.querySelectorAll('.scroll-reveal');

if (revealItems.length > 0) {
	if (!('IntersectionObserver' in window)) {
		revealItems.forEach((element) => element.classList.add('is-visible'));
	} else {
		const revealObserver = new IntersectionObserver((entries, observer) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		}, {
			root: null,
			rootMargin: '0px 0px -12% 0px',
			threshold: 0.12,
		});

		revealItems.forEach((element) => revealObserver.observe(element));
	}
}

Alpine.start();
