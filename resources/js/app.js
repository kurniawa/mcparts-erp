import './bootstrap';
import '../css/app.css';
import 'v-calendar/style.css';

import { createApp, h } from 'vue';
import { createInertiaApp, router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import nProgress from 'nprogress';

const appName = import.meta.env.VITE_APP_NAME || 'MC-ERP';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        // The delay after which the progress bar will appear, in milliseconds...
        delay: 250,

        // The color of the progress bar...
        // color: "#4B5563",
        color: "#29d",

        // Whether to include the default NProgress styles...
        includeCSS: true,

        // Whether the NProgress spinner will be shown...
        showSpinner: true,
    },
});

let timeout = null;

router.on("start", () => {
    timeout = setTimeout(() => nProgress.start(), 250);
});

router.on("progress", (event) => {
    if (nProgress.isStarted() && event.detail.progress.percentage) {
        nProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
});

router.on("finish", (event) => {
    clearTimeout(timeout);
    if (!nProgress.isStarted()) {
        return;
    } else if (event.detail.visit.completed) {
        nProgress.done();
    } else if (event.detail.visit.interrupted) {
        nProgress.set(0);
    } else if (event.detail.visit.cancelled) {
        nProgress.done();
        nProgress.remove();
    }
});
