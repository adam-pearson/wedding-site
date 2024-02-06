const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './public/index.php',
        './resources/**/*.{vue,js,ts,jsx,tsx}',
    ],
    theme: {
        extend: {
            colors: {
                white: '#ffffff',
                primary: '#BD945A',
                secondary: '#F6F1F0',
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
