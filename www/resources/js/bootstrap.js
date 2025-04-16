import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import App from './Pages/App.vue';
import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createInertiaApp({
    resolve: name => {
        const
            pages = import.meta.glob('./Pages/**/*.vue', {eager: true}),
            page = pages[`./Pages/${name}.vue`]
        ;

        page.default.layout = page.default.layout || App

        return pages[`./Pages/${name}.vue`];
    },

    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .mount(el);
    },
});
