import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'public/assets/css/main.css',
                'public/assets/css/style.bundle.css',
                'public/assets/plugins/global/plugins.bundle.css',
                'public/assets/plugins/custom/datatables/datatables.bundle.css',
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
