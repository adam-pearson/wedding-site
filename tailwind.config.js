import plugin from 'tailwindcss/plugin';
import forms from '@tailwindcss/forms';

const vueform = require('@vueform/vueform/tailwind');

const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
export default {
    vfDarkMode: false,
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
                primary: {
                    100: '#d1d6df',
                    200: '#a3adbf',
                    300: '#76859f',
                    400: '#485c7f',
                    500: '#1a335f',
                    600: '#15294c',
                    700: '#101f39',
                    800: '#0a1426',
                },
                secondary: {
                    100: '#fff8cd',
                    200: '#fff09a',
                    300: '#ffe968',
                    400: '#ffe135',
                    500: '#ffda03',
                    600: '#ccae02',
                    700: '#998302',
                    800: '#665701',
                },
                offwhite: {
                    500: '#fdfcf9',
                },
                gray: {
                    50: '#F9FAFB',
                    100: '#F3F4F6',
                    200: '#E5E7EB',
                    300: '#BFC4CD',
                    400: '#9CA3AF',
                    500: '#6B7280',
                    600: '#4B5563',
                    700: '#374151',
                    800: '#1F2937',
                    900: '#111827',
                    950: '#030712',
                },
                violet: {
                    50: '#F1EEFF',
                    100: '#E6E1FF',
                    200: '#D2CBFF',
                    300: '#B7ACFF',
                    400: '#9C8CFF',
                    500: '#8470FF',
                    600: '#755FF8',
                    700: '#5D47DE',
                    800: '#4634B1',
                    900: '#2F227C',
                    950: '#1C1357',
                },
                sky: {
                    50: '#E3F3FF',
                    100: '#D1ECFF',
                    200: '#B6E1FF',
                    300: '#A0D7FF',
                    400: '#7BC8FF',
                    500: '#67BFFF',
                    600: '#56B1F3',
                    700: '#3193DA',
                    800: '#1C71AE',
                    900: '#124D79',
                    950: '#0B324F',
                },
                green: {
                    50: '#D2FFE2',
                    100: '#B1FDCD',
                    200: '#8BF0B0',
                    300: '#67E294',
                    400: '#4BD37D',
                    500: '#3EC972',
                    600: '#34BD68',
                    700: '#239F52',
                    800: '#15773A',
                    900: '#0F5429',
                    950: '#0A3F1E',
                },
                red: {
                    50: '#FFE8E8',
                    100: '#FFD1D1',
                    200: '#FFB2B2',
                    300: '#FF9494',
                    400: '#FF7474',
                    500: '#FF5656',
                    600: '#FA4949',
                    700: '#E63939',
                    800: '#C52727',
                    900: '#941818',
                    950: '#600F0F',
                },
                yellow: {
                    50: '#FFF2C9',
                    100: '#FFE7A0',
                    200: '#FFE081',
                    300: '#FFD968',
                    400: '#F7CD4C',
                    500: '#F0BB33',
                    600: '#DFAD2B',
                    700: '#BC9021',
                    800: '#816316',
                    900: '#4F3D0E',
                    950: '#342809',
                },
            },
            fontFamily: {
                script: ['Alex Brush', 'Brush Script MT', 'cursive'],
                serif: ['Cormorant Garamond', ...defaultTheme.fontFamily.sans],
                sans: ['Nunito Sans', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', 'sans-serif'],
            },
            fontSize: {
                xs: ['0.75rem', { lineHeight: '1.5' }],
                sm: ['0.875rem', { lineHeight: '1.5715' }],
                base: ['1rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                lg: ['1.125rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                xl: ['1.25rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
                '2xl': ['1.5rem', { lineHeight: '1.33', letterSpacing: '-0.01em' }],
                '3xl': ['1.88rem', { lineHeight: '1.33', letterSpacing: '-0.01em' }],
                '4xl': ['2.25rem', { lineHeight: '1.25', letterSpacing: '-0.02em' }],
                '5xl': ['3rem', { lineHeight: '1.25', letterSpacing: '-0.02em' }],
                '6xl': ['3.75rem', { lineHeight: '1.2', letterSpacing: '-0.02em' }],
            },
            screens: {
                xs: '480px',
            },
            borderWidth: {
                3: '3px',
            },
            minWidth: {
                36: '9rem',
                44: '11rem',
                56: '14rem',
                60: '15rem',
                72: '18rem',
                80: '20rem',
            },
            maxWidth: {
                '8xl': '88rem',
                '9xl': '96rem',
            },
            zIndex: {
                60: '60',
            },
            transitionProperty: {
                width: 'width',
            },
            form: (theme) => ({
                primary: theme('colors.primary.500'),
                primaryDarker: theme('colors.primary.600'), // defaults to 10% darker primary

                danger: theme('colors.red.500'),
                dangerLighter: theme('colors.red.100'),

                success: theme('colors.green.500'),
                successLighter: theme('colors.green.100'),

                ringColor: theme('colors.primary.200'), // defaults to primary with `ringOpacity` alpha
                ringWidth: theme('ringWidth.base'),
                ringOpacity: 0.2,

                linkColor: 'var(--vf-primary)',
                linkDecoration: 'none',

                grays: theme('colors.gray'),
                darks: theme('colors.gray'),

                fontSize: {
                    base: theme('fontSize.base'),
                    sm: theme('fontSize.sm'),
                    lg: theme('fontSize.base'),
                },

                smallFontSize: {
                    base: theme('fontSize.sm'),
                    sm: theme('fontSize')['0.5sm'],
                    lg: theme('fontSize.sm'),
                },

                h1FontSize: {
                    base: '2.125rem',
                    sm: '2.125rem',
                    lg: '2.125rem',
                },

                h2FontSize: {
                    base: '1.875rem',
                    sm: '1.875rem',
                    lg: '1.875rem',
                },

                h3FontSize: {
                    base: '1.5rem',
                    sm: '1.5rem',
                    lg: '1.5rem',
                },

                h4FontSize: {
                    base: '1.25rem',
                    sm: '1.25rem',
                    lg: '1.25rem',
                },

                h1MobileFontSize: {
                    base: '1.5rem',
                    sm: '1.5rem',
                    lg: '1.5rem',
                },

                h2MobileFontSize: {
                    base: '1.25rem',
                    sm: '1.25rem',
                    lg: '1.25rem',
                },

                h3MobileFontSize: {
                    base: '1.125rem',
                    sm: '1.125rem',
                    lg: '1.125rem',
                },

                h4MobileFontSize: {
                    base: '1rem',
                    sm: '1rem',
                    lg: '1rem',
                },

                blockquoteFontSize: {
                    base: '1rem',
                    sm: '0.875rem',
                    lg: '1rem',
                },

                lineHeight: {
                    base: theme('fontSize.base')[1].lineHeight,
                    sm: theme('fontSize.sm')[1].lineHeight,
                    lg: theme('fontSize.base')[1].lineHeight,
                },

                headingsLineHeight: {
                    base: '1.2',
                    sm: '1.2',
                    lg: '1.2',
                },

                blockquoteLineHeight: {
                    base: '1.5rem',
                    sm: '1.25rem',
                    lg: '1.5rem',
                },

                smallLineHeight: {
                    base: theme('fontSize.sm')[1].lineHeight,
                    sm: theme('fontSize')['0.5sm'][1].lineHeight,
                    lg: theme('fontSize.sm')[1].lineHeight,
                },

                letterSpacing: {
                    base: 0,
                    sm: 0,
                    lg: 0,
                },

                smallLetterSpacing: {
                    base: 0,
                    sm: 0,
                    lg: 0,
                },

                headingsLetterSpacing: {
                    base: 0,
                    sm: 0,
                    lg: 0,
                },

                blockquoteLetterSpacing: {
                    base: 0,
                    sm: 0,
                    lg: 0,
                },

                gutter: {
                    base: theme('width')['4'],
                    sm: theme('width')['2'],
                    lg: theme('width')['4'],
                },

                inputMinHeight: {
                    base: theme('height')['9.5'],
                    sm: theme('height')['8.5'],
                    lg: theme('height')['11.5'],
                },

                inputPy: {
                    base: theme('padding')['1.5'],
                    sm: theme('padding')['1.5'],
                    lg: theme('padding')['2.5'],
                },

                inputPx: {
                    base: theme('padding')['3'],
                    sm: theme('padding')['2'],
                    lg: theme('padding')['3.5'],
                },

                btnPy: {
                    base: theme('padding')['1.5'],
                    sm: theme('padding')['1.5'],
                    lg: theme('padding')['2.5'],
                },

                btnPx: {
                    base: theme('padding')['2'],
                    sm: theme('padding')['3'],
                    lg: theme('padding')['5'],
                },

                btnSmallPy: {
                    base: theme('padding')['1'],
                    sm: theme('padding')['1'],
                    lg: theme('padding')['1.5'],
                },

                btnSmallPx: {
                    base: theme('padding')['2.5'],
                    sm: theme('padding')['2.5'],
                    lg: theme('padding')['3'],
                },

                tagPy: {
                    base: '0px',
                    sm: 'var(--vf-py-tag)',
                    lg: 'var(--vf-py-tag)',
                },

                tagPx: {
                    base: theme('padding')['1.75'],
                    sm: 'var(--vf-px-tag)',
                    lg: 'var(--vf-px-tag)',
                },

                groupTabsPy: {
                    base: 'var(--vf-py-input)',
                    sm: 'var(--vf-py-input-sm)',
                    lg: 'var(--vf-py-input-lg)',
                },

                groupTabsPx: {
                    base: 'var(--vf-px-input)',
                    sm: 'var(--vf-px-input-sm)',
                    lg: 'var(--vf-px-input-lg)',
                },

                groupBlocksPy: {
                    base: theme('padding')['3'],
                    sm: theme('padding')['2.5'],
                    lg: theme('padding')['3.5'],
                },

                groupBlocksPx: {
                    base: theme('padding')['4'],
                    sm: theme('padding')['4'],
                    lg: theme('padding')['4'],
                },

                sliderTooltipPy: {
                    base: theme('padding')['0.5'],
                    sm: theme('padding')['0.25'],
                    lg: theme('padding')['0.75'],
                },

                sliderTooltipPx: {
                    base: theme('padding')['1.5'],
                    sm: theme('padding')['1.25'],
                    lg: theme('padding')['2'],
                },

                blockquotePy: {
                    base: '0.25rem',
                    sm: '0.25rem',
                    lg: '0.25rem',
                },

                blockquotePx: {
                    base: '0.75rem',
                    sm: '0.75rem',
                    lg: '0.75rem',
                },

                hrPy: {
                    base: '2rem',
                },

                spaceAddon: {
                    base: '0px',
                    sm: 'var(--vf-space-addon)',
                    lg: 'var(--vf-space-addon)',
                },

                spaceCheckbox: {
                    base: theme('padding')['1.5'],
                    sm: 'var(--vf-space-checkbox)',
                    lg: 'var(--vf-space-checkbox)',
                },

                spaceTags: {
                    base: theme('padding')['0.75'],
                    sm: 'var(--vf-space-tags)',
                    lg: 'var(--vf-space-tags)',
                },

                spaceStaticTag1: '1rem',
                spaceStaticTag2: '2rem',
                spaceStaticTag3: '3rem',

                floatingTop: {
                    base: '0px',
                    sm: '0px',
                    lg: theme('padding')['2.75'],
                },

                borderWidths: { // can be array
                    input: theme('borderWidth.DEFAULT'),
                    dropdown: [
                        'var(--vf-border-width-input-t)',
                        'var(--vf-border-width-input-r)',
                        'var(--vf-border-width-input-b)',
                        'var(--vf-border-width-input-l)',
                    ],
                    checkbox: [
                        'var(--vf-border-width-input-t)',
                        'var(--vf-border-width-input-r)',
                        'var(--vf-border-width-input-b)',
                        'var(--vf-border-width-input-l)',
                    ],
                    radio: [
                        'var(--vf-border-width-input-t)',
                        'var(--vf-border-width-input-r)',
                        'var(--vf-border-width-input-b)',
                        'var(--vf-border-width-input-l)',
                    ],
                    btn: [
                        'var(--vf-border-width-input-t)',
                        'var(--vf-border-width-input-r)',
                        'var(--vf-border-width-input-b)',
                        'var(--vf-border-width-input-l)',
                    ],
                    toggle: theme('width')['0.5'],
                    tag: '1px',
                    blockquote: '3px',
                },

                inputRadius: { // can be array
                    base: 0,
                    sm: 'var(--vf-radius-input)',
                    lg: 'var(--vf-radius-input)',
                },

                btnRadius: { // can be array
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                smallRadius: { // can be array, applies to: checkbox, tags, slider tooltips
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                largeRadius: { //  // can be array, applies to: drag and drop, checkbox & radio group blocks, textarea, native multiselect
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                tagRadius: {
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                checkboxRadius: { // can be array
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                sliderRadius: { // can be array
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                imageRadius: { // can be array
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                galleryRadius: { // can be array
                    base: 'var(--vf-radius-input)',
                    sm: 'var(--vf-radius-input-sm)',
                    lg: 'var(--vf-radius-input-lg)',
                },

                bgColors: {
                    input: '#ffffff',
                    inputHover: 'var(--vf-bg-input)',
                    inputFocus: 'var(--vf-bg-input)',
                    inputDanger: 'var(--vf-bg-input)',
                    inputSuccess: 'var(--vf-bg-input)',
                    disabled: 'var(--vf-gray-200)',
                    selected: 'rgba(17,24,39,0.05)', // Option hover, cbgroup blocks selected
                    passive: 'var(--vf-gray-300)',
                    icon: 'var(--vf-gray-500)',
                    danger: 'var(--vf-danger-lighter)',
                    success: 'var(--vf-success-lighter)',
                    addon: 'transparent',
                    tag: 'var(--vf-primary)',
                    sliderHandle: 'var(--vf-primary)',
                    toggleHandle: '#ffffff',
                    dateHead: 'var(--vf-gray-100)',
                    btn: 'var(--vf-primary)',
                    btnDanger: 'var(--vf-danger)',
                    btnSecondary: 'var(--vf-gray-200)',
                },

                textColors: {
                    onPrimary: '#ffffff',
                    input: 'var(--vf-gray-800)',
                    inputHover: 'var(--vf-color-input)',
                    inputFocus: 'var(--vf-color-input)',
                    inputDanger: 'var(--vf-color-input)',
                    inputSuccess: 'var(--vf-color-input)',
                    placeholder: 'var(--vf-gray-300)',
                    disabled: 'var(--vf-gray-400)',
                    passive: 'var(--vf-gray-700)',
                    muted: 'var(--vf-gray-500)',
                    floating: 'var(--vf-color-muted)',
                    floatingFocus: 'var(--vf-color-floating)',
                    floatingSuccess: 'var(--vf-color-floating)',
                    floatingDanger: 'var(--vf-color-floating)',
                    danger: 'var(--vf-danger)',
                    success: 'var(--vf-success)',
                    addon: 'inherit',
                    tag: 'var(--vf-color-on-primary)',
                    dateHead: 'var(--vf-gray-700)',
                    btn: 'var(--vf-color-on-primary)',
                    btnDanger: '#ffffff',
                    btnSecondary: 'var(--vf-gray-700)',
                },

                borderColors: {
                    input: 'var(--vf-gray-300)',
                    inputFocus: 'var(--vf-primary)',
                    inputHover: 'var(--vf-border-color-input)',
                    inputDanger: 'var(--vf-border-color-input)',
                    inputSuccess: 'var(--vf-border-color-input)',
                    checked: 'var(--vf-primary)', // applies to checkbox & radio
                    btn: 'var(--vf-primary)',
                    tag: 'var(--vf-primary)',
                    sliderTooltip: 'var(--vf-primary)',
                    passive: 'var(--vf-gray-300)',
                    btnDanger: 'var(--vf-danger)',
                    btnSecondary: 'var(--vf-gray-200)',
                    blockquote: 'var(--vf-gray-300)',
                    hr: 'var(--vf-gray-300)',
                },

                shadows: {
                    input: '0px 0px 0px 0px rgba(0,0,0,0)',
                    inputHover: 'var(--vf-shadow-input)',
                    inputFocus: 'var(--vf-shadow-input)',
                    handles: '0px 0px 0px 0px rgba(0,0,0,0)',
                    handlesHover: 'var(--vf-shadow-input-hover)',
                    handlesFocus: 'var(--vf-shadow-input-focus)',
                    btn: 'var(--vf-shadow-input)',
                    dropdown: 'var(--vf-shadow-input)',
                },

                bgColorsDark: {
                    input: 'var(--vf-dark-800)',
                    inputHover: 'var(--vf-bg-input)',
                    inputFocus: 'var(--vf-bg-input)',
                    inputDanger: 'var(--vf-bg-input)',
                    inputSuccess: 'var(--vf-bg-input)',
                    checkbox: 'var(--vf-dark-700)',
                    checkboxHover: 'var(--vf-bg-checkbox)',
                    checkboxFocus: 'var(--vf-bg-checkbox)',
                    checkboxDanger: 'var(--vf-bg-checkbox)',
                    checkboxSuccess: 'var(--vf-bg-checkbox)',
                    disabled: 'var(--vf-dark-700)',
                    selected: 'var(--vf-dark-700)', // Option hover, cbgroup blocks selected
                    passive: 'var(--vf-dark-700)',
                    icon: 'var(--vf-dark-400)',
                    danger: 'var(--vf-danger-lighter)',
                    success: 'var(--vf-success-lighter)',
                    addon: 'transparent',
                    tag: 'var(--vf-primary)',
                    sliderHandle: 'var(--vf-primary)',
                    toggleHandle: '#ffffff',
                    dateHead: 'var(--vf-dark-700)',
                    btn: 'var(--vf-primary)',
                    btnDanger: 'var(--vf-danger)',
                    btnSecondary: 'var(--vf-dark-700)',
                },

                textColorsDark: {
                    onPrimary: '#ffffff',
                    input: 'var(--vf-dark-100)',
                    inputHover: 'var(--vf-color-input)',
                    inputFocus: 'var(--vf-color-input)',
                    inputDanger: 'var(--vf-color-input)',
                    inputSuccess: 'var(--vf-color-input)',
                    placeholder: 'var(--vf-dark-500)',
                    disabled: 'var(--vf-dark-500)',
                    passive: 'var(--vf-dark-900)',
                    muted: 'var(--vf-dark-500)',
                    floating: 'var(--vf-color-muted)',
                    floatingFocus: 'var(--vf-color-floating)',
                    floatingSuccess: 'var(--vf-color-floating)',
                    floatingDanger: 'var(--vf-color-floating)',
                    danger: 'var(--vf-danger)',
                    success: 'var(--vf-success)',
                    addon: 'initial',
                    tag: 'var(--vf-color-on-primary)',
                    dateHead: 'var(--vf-dark-200)',
                    btn: 'var(--vf-color-on-primary)',
                    btnDanger: '#ffffff',
                    btnSecondary: 'var(--vf-dark-300)',
                },

                borderColorsDark: {
                    input: 'var(--vf-dark-800)',
                    inputFocus: 'var(--vf-primary)',
                    inputHover: 'var(--vf-border-color-input)',
                    inputDanger: 'var(--vf-border-color-input)',
                    inputSuccess: 'var(--vf-border-color-input)',
                    checkbox: 'var(--vf-border-color-input)',
                    checkboxFocus: 'var(--vf-primary)',
                    checkboxHover: 'var(--vf-border-color-checkbox)',
                    checkboxDanger: 'var(--vf-border-color-checkbox)',
                    checkboxSuccess: 'var(--vf-border-color-checkbox)',
                    checked: 'var(--vf-primary)', // applies to checkbox & radio
                    btn: 'var(--vf-primary)',
                    tag: 'var(--vf-primary)',
                    sliderTooltip: 'var(--vf-primary)',
                    passive: 'var(--vf-dark-700)',
                    btnDanger: 'var(--vf-danger)',
                    btnSecondary: 'var(--vf-dark-700)',
                    blockquote: 'var(--vf-dark-700)',
                    hr: 'var(--vf-dark-700)',
                },

                shadowsDark: {
                    input: '0px 0px 0px 0px rgba(0,0,0,0)',
                    inputHover: 'var(--vf-shadow-input)',
                    inputFocus: 'var(--vf-shadow-input)',
                    handles: '0px 0px 0px 0px rgba(0,0,0,0)',
                    handlesHover: 'var(--vf-shadow-input-hover)',
                    handlesFocus: 'var(--vf-shadow-input-focus)',
                    btn: 'var(--vf-shadow-input)',
                    dropdown: 'var(--vf-shadow-input)',
                },

                checkboxSize: {
                    base: theme('width')['4'],
                    sm: theme('width')['3.5'],
                    lg: theme('width')['4'],
                },

                gallerySize: {
                    base: theme('width')['24'],
                    sm: theme('width')['20'],
                    lg: theme('width')['28'],
                },

                toggleWidth: {
                    base: theme('width')['12'],
                    sm: theme('width')['11'],
                    lg: theme('width')['12'],
                },

                toggleHeight: {
                    base: theme('height')['5'],
                    sm: theme('height')['4'],
                    lg: theme('height')['5'],
                },

                sliderHeight: {
                    base: theme('height')['1.5'],
                    sm: theme('height')['1.25'],
                    lg: theme('height')['2'],
                },

                sliderHeightVertical: {
                    base: theme('height')['80'],
                    sm: 'var(--vf-slider-height-vertical)',
                    lg: 'var(--vf-slider-height-vertical)',
                },

                sliderHandleSize: {
                    base: theme('height')['4'],
                    sm: theme('height')['3.5'],
                    lg: theme('height')['5'],
                },

                sliderTooltipDistance: {
                    base: theme('width')['2'],
                    sm: theme('width')['1.5'],
                    lg: theme('width')['2'],
                },

                sliderTooltipArrowSize: {
                    base: theme('width')['1.25'],
                    sm: 'var(--vf-slider-tooltip-arrow-size)',
                    lg: 'var(--vf-slider-tooltip-arrow-size)',
                },
            }),
        },
    },
    plugins: [
        forms,
        vueform,
        // add custom variant for expanding sidebar
        plugin(({ addVariant, e }) => {
            addVariant('sidebar-expanded', ({ modifySelectors, separator }) => {
                modifySelectors(({ className }) => `.sidebar-expanded .${e(`sidebar-expanded${separator}${className}`)}`);
            });
        }),
    ],
};
