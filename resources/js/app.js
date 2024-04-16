import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from 'ziggy-js';
import Vueform from '@vueform/vueform';
import vueformConfig from '../../vueform.config';

createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./**/views/**/*.vue', { import: 'default' });
        return pages[`./${name}.vue`]();
    },
    setup({
        el, App, props, plugin,
    }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Vueform, vueformConfig)
            .mount(el);
    },
});
