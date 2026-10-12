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
            colors: {
                despacho: {
                    navy: '#0B0F19',      // Azul marino profundo del logotipo
                    gold: '#C5A059',      // Dorado ejecutivo/metálico
                    goldHover: '#B08D4C', // Dorado para efectos hover
                }
            },
        },
    },

    plugins: [forms],
};