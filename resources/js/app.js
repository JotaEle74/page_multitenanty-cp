

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from 'ziggy-js';

const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });

createInertiaApp({
	resolve: name => {
		const page = pages[`./Pages/${name.replace(/\./g, '/')}.vue`];
		if (!page) {
			throw new Error(`Unknown page: ${name}`);
		}
		return page;
	},
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.use(ZiggyVue, {
				// Ziggy routes will be injected automatically by the backend
			})
			.mount(el);
	},
});
