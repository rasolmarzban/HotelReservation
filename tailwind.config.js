import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                    transparent: 'transparent',
                    current: 'currentColor',
                    //amber: colors.amber,
                    black: colors.black,
                    blue: colors.blue,
                    cyan: colors.cyan,
                    emerald: colors.emerald,
                    fuchsia: colors.fuchsia,
                    gray: colors.trueGray,
                    blueGray: colors.blueGray,
                    coolGray: colors.coolGray,
                    //trueGray: colors.trueGray,
                    warmGray: colors.warmGray,
                    green: colors.green,
                    indigo: colors.indigo,
                    lime: colors.lime,
                    orange: colors.orange,
                    pink: colors.pink,
                    purple: colors.purple,
                    red: colors.red,
                    rose: colors.rose,
                    sky: colors.sky,//warn - As of Tailwind CSS v2.2, `lightBlue` has been renamed to `sky`.
                    teal: colors.teal,
                    violet: colors.violet,
                    yellow: colors.amber,
                    white: colors.white,
            }
        },
    },

    plugins: [forms, typography],
};
