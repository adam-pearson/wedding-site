const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './public/index.php',
    './resources/**/*.{vue,js,ts,jsx,tsx}',
  ],
  theme: {
    extend: {
      fontFamily: {
        script: ['Alex Brush', 'cursive'],
        sans: ['Nunito Sans', ...defaultTheme.fontFamily.sans]
      },
    },
  },
  plugins: [],
}

