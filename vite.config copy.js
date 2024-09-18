import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import postcss from './postcss.config.js';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
        postcss(),
    ],
});

