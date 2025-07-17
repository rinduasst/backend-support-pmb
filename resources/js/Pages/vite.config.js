import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/dashboard.jsx'],

            refresh: true,
        }),
        react(),
    ],
    server: {
        proxy: {
            '/': 'http://127.0.0.1:8000', // Laravel backend
        },
    },
});
