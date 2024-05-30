import { defineConfig, normalizePath  } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';


export default defineConfig({
    server: {
        port: 5173,
        host: true,
        origin: "http://localhost:5173",
        // hmr: {
        //     host: 'localhost',
        // },
    },
    plugins: [
        laravel({
            input: [
                normalizePath ('resources/css/app.css'),
                normalizePath ('resources/js/app.js'),
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,

                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js',
            '@': normalizePath('/resources/js/components/'),
        },
    },
});
