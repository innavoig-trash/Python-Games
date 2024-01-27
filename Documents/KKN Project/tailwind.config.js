import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                sans: ['Cal Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                plant: {
                    '50': '#f0fdf5',
                    '100': '#dcfce8',
                    '200': '#bbf7d1',
                    '300': '#86efad',
                    '400': '#4ade81',
                    '500': '#22c55e',
                    '600': '#16a34a',
                    '700': '#15803c',
                    '800': '#166533',
                    '900': '#14532b',
                    '950': '#052e14',
                },
            }
        },
    },
    plugins: [forms],
};
