import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/scss/index.scss',
            //'resources/js/app.js',
        ]),
    ],
});