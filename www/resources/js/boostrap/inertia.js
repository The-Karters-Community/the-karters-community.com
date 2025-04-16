import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import App from './../Pages/App.vue';

createInertiaApp({
    resolve: name => {
        const
            pages = import.meta.glob('./../Pages/**/*.vue', {eager: true}),
            page = pages[`../Pages/${name}.vue`]
        ;

        page.default.layout = page.default.layout || App

        return page;
    },

    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .mount(el);
    },
});
