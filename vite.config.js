import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'vendor/akaunting/laravel-language/src/Resources/assets/img/flags/us.png',
                'vendor/akaunting/laravel-language/src/Resources/assets/img/flags/ru.png'
            ],
            refresh: true,
        }),
    ],
});
