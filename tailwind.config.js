import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Nilai spacing tambahan yang dipakai di views tapi tidak ada
            // di default Tailwind scale (... 4, 5, 6 ... 14, 16, 20 ...)
            spacing: {
                '4.5': '1.125rem',  // untuk w-4.5, h-4.5, p-4.5, dll
                '18':  '4.5rem',    // untuk py-18, px-18, mt-18, dll
            },
            // Nilai opacity tambahan untuk modifier warna seperti:
            // bg-white/8, text-white/35, bg-white/96, dll
            opacity: {
                '8':  '0.08',
                '15': '0.15',
                '18': '0.18',
                '35': '0.35',
                '55': '0.55',
                '65': '0.65',
                '96': '0.96',
            },
        },
    },

    plugins: [forms],
};
