import defaultTheme from 'tailwindcss/defaultTheme';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                display: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#eefdf5',
                    100: '#d6f9e4',
                    200: '#aef1cb',
                    300: '#78e3ab',
                    400: '#3fce87',
                    500: '#1cb96b',
                    600: '#129a57',
                    700: '#117b48',
                    800: '#12613b',
                    900: '#0f4f32',
                    950: '#062c1b',
                },
                ink: {
                    50: '#f6f7f8',
                    100: '#eceef0',
                    200: '#d5d9de',
                    300: '#b1b9c2',
                    400: '#8691a0',
                    500: '#667284',
                    600: '#525c6d',
                    700: '#434b59',
                    800: '#39404b',
                    900: '#171a1f',
                    950: '#0c0e11',
                },
            },
            boxShadow: {
                soft: '0 2px 8px -2px rgb(15 23 42 / 0.06), 0 8px 24px -4px rgb(15 23 42 / 0.08)',
                'soft-lg': '0 8px 30px -6px rgb(15 23 42 / 0.10), 0 20px 48px -8px rgb(15 23 42 / 0.12)',
            },
            borderRadius: {
                '2xl': '1rem',
                '3xl': '1.5rem',
            },
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #3fce87 0%, #129a57 55%, #0f4f32 100%)',
            },
        },
    },
    plugins: [
        typography,
    ],
};
