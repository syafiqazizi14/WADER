import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

const header = document.querySelector('.layout-header');

if (header) {
	const syncHeaderState = () => {
		header.classList.toggle('is-scrolled', window.scrollY > 8);
	};

	syncHeaderState();
	window.addEventListener('scroll', syncHeaderState, { passive: true });
}

Alpine.start();
