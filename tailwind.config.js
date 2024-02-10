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
                primary: '#b87921',
                secondary: '#F6F1F0',
            },
            fontFamily: {
                script: ['Alex Brush', 'Brush Script MT', 'cursive'],
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
