import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from 'ziggy-js';
import Vueform from '@vueform/vueform';
import { MotionPlugin } from '@vueuse/motion';
import vueformConfig from '../../vueform.config';

createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./**/views/**/*.vue', { eager: true });
        return pages[`./${name}.vue`];
    },
    setup({
        el,
        App,
        props,
        plugin,
    }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin);
        app.use(ZiggyVue);
        app.use(Vueform, vueformConfig);
        app.use(MotionPlugin);
        app.mount(el);
    },
});
