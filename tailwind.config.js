const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/js/**/*.vue'],

    theme: {
        inset: {
            '0': '0',
            // '-1': '-0.25rem',
            // '-2': '-0.5rem',
            // '-3': '-0.75rem',
            '-4': '-1rem',
            // '-5': '-1.25rem',
            // '-6': '-1.5rem',
            '-8': '-2rem',
            '1': '0.25rem',
            '2': '0.5rem',
            '3': '0.75rem',
            '4': '1rem',
            // '5': '1.25rem',
            // '6': '1.5rem',
            // '8': '2rem',
            // '10': '2.5rem',
            // '12': '3rem',
            // '16': '4rem',
            // '20': '5rem',
            // '24': '6rem',
            // '32': '8rem',
            // '40': '10rem',
            // '48': '12rem',
            // '56': '14rem',
            // '64': '16rem',
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
            maxHeight: {
                '64': '15rem',
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
            height: {
                '18': '4.5rem',
                '30': '7.5rem',
                '36': '9rem',
                '42': '10.5rem',
                '54': '15rem'
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled','group-hover','group-focus'],
        display: ['responsive', 'group-hover', 'group-focus'],
        height: ['responsive','hover','focus','group-hover','group-focus'],
        borderWidth: ['responsive', 'hover'],
        borderColor: ['responsive', 'hover', 'group-hover', 'group-focus'],
    },

    plugins: [require('@tailwindcss/ui')],
};
