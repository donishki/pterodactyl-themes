const colors = require('tailwindcss/colors');

const grayChannels = {
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

// Functions support opacity in both Tailwind utilities and twin.macro 2.x.
const themedColor = (role, fallback) => ({ opacityValue = 1 }) =>
    `rgb(var(--theme-rgb-${role}, ${fallback}) / ${opacityValue})`;
const gray = Object.fromEntries(Object.entries(grayChannels).map(([shade, rgb]) => [shade, themedColor(`gray-${shade}`, rgb)]));
const channels = color => color.replace('#', '').match(/../g).map(x => parseInt(x, 16)).join(' ');
const themedBlue = Object.fromEntries(Object.entries(colors.blue).map(([shade, color]) => [shade, themedColor(`blue-${shade}`, channels(color))]));

module.exports = {
    content: [
        './resources/scripts/**/*.{js,ts,tsx}',
    ],
    theme: {
        extend: {
            textColor: {
                ...Object.fromEntries(['gray', 'neutral'].map(name => [name,
                    Object.fromEntries([500, 600, 700, 800, 900].map(shade => [shade,
                        themedColor(shade <= 600 ? 'muted' : 'text', grayChannels[shade])
                    ]))
                ])),
            },
            fontFamily: {
                header: ['var(--theme-font, "IBM Plex Sans")', 'system-ui', 'sans-serif'],
                sans: ['var(--theme-font, "IBM Plex Sans")', 'system-ui', 'sans-serif'],
            },
            colors: {
                black: '#131a20',
                blue: themedBlue,
                // "primary" and "neutral" are deprecated, prefer the use of "blue" and "gray"
                // in new code.
                primary: themedBlue,
                gray: gray,
                neutral: gray,
                cyan: Object.fromEntries(Object.entries(colors.cyan).map(([shade, color]) => [shade, themedColor(`blue-${shade}`, channels(color))])),
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
