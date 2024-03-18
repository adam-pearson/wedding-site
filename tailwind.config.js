const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './public/index.php',
        './resources/**/*.{vue,js,ts,jsx,tsx}',
        './vueform.config.js',
        './node_modules/@vueform/vueform/themes/tailwind/**/*.vue',
        './node_modules/@vueform/vueform/themes/tailwind/**/*.js',
    ],
    theme: {
        extend: {
            animation: {
                'spin-slow': 'spin 12s linear infinite',
            },
            colors: {
                white: '#ffffff',
                'primary-800': '#291B07',
                'primary-700': '#593A10',
                'primary-600': '#885A18',
                'primary-500': '#b87921',
                'primary-400': '#D98F29',
                'primary-300': '#DFA14C',
                'primary-200': '#E5B46E',
                'primary-100': '#EBC691',
                'primary-50': '#EECFA2',
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
    plugins: [
        require('@tailwindcss/forms'),
        require('@vueform/vueform/tailwind'),
    ],
};
