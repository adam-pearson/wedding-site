const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './public/index.php',
        './resources/**/*.{vue,js,ts,jsx,tsx}',
    ],
    theme: {
        extend: {
            animation: {
                'spin-slow': 'spin 12s linear infinite',
            },
            colors: {
                white: '#ffffff',
                primary: '#BD945A',
                secondary: '#F6F1F0',
                lightgray: '#888',
            },
            fontFamily: {
                script: ['Alex Brush', 'cursive'],
                serif: ['Cormorant Garamond', ...defaultTheme.fontFamily.sans],
                sans: ['Nunito Sans', ...defaultTheme.fontFamily.sans],
            },
            transitionProperty: {
                width: 'width',
            },
        },
    },
    plugins: [],
};
