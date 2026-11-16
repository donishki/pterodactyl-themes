const colors = require('tailwindcss/colors');

const gray = {
    50: '245 247 250',
    100: '229 232 235',
    200: '202 209 216',
    300: '154 165 177',
    400: '123 135 147',
    500: '96 109 123',
    600: '81 95 108',
    700: '63 77 90',
    800: '51 64 76',
    900: '31 41 51',
};

for (const shade of Object.keys(gray)) { gray[shade] = `rgb(var(--theme-rgb-gray-${shade}, ${gray[shade]}) / <alpha-value>)`; }
const channels = color => color.replace('#', '').match(/../g).map(x => parseInt(x, 16)).join(' ');
const themedBlue = Object.fromEntries(Object.entries(colors.blue).map(([shade, color]) => [shade, `rgb(var(--theme-rgb-accent, ${channels(color)}) / <alpha-value>)`]));

module.exports = {
    content: [
        './resources/scripts/**/*.{js,ts,tsx}',
    ],
    theme: {
        extend: {
            fontFamily: {
                header: ['"IBM Plex Sans"', '"Roboto"', 'system-ui', 'sans-serif'],
            },
            colors: {
                black: 'rgb(var(--theme-rgb-background, 19 26 32) / <alpha-value>)',
                blue: themedBlue,
                // "primary" and "neutral" are deprecated, prefer the use of "blue" and "gray"
                // in new code.
                primary: themedBlue,
                gray: gray,
                neutral: gray,
                cyan: Object.fromEntries(Object.entries(colors.cyan).map(([shade, color]) => [shade, `rgb(var(--theme-rgb-accent, ${channels(color)}) / <alpha-value>)`])),
            },
            borderRadius: { DEFAULT: 'var(--theme-radius, 0.25rem)', md: 'var(--theme-radius, 0.375rem)', lg: 'var(--theme-radius, 0.5rem)' },
            fontSize: {
                '2xs': '0.625rem',
            },
            transitionDuration: {
                250: '250ms',
            },
            borderColor: theme => ({
                default: theme('colors.neutral.400', 'currentColor'),
            }),
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
    ]
};
