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
            colors: {
                primary: '#3B1E1F', // vino profundo más neutro
                secondary: '#231617', // contraste oscuro
                dark: '#0B0909',
                light: '#FFFFFF', // blanco
                accent: '#B8A06A', // dorado atenuado
            },
            fontFamily: {
                sans: ['"Manrope"', ...defaultTheme.fontFamily.sans],
                heading: ['"Cormorant Garamond"', 'serif'],
                body: ['"Manrope"', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
