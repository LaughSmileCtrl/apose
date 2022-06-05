const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    container: {
      padding: {
        DEFAULT: '0rem',
        sm: '0rem',
        lg: '2rem',
        xl: '3rem',
        '2xl': '4rem',
      },
    },
    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
    plugin(function ({ addBase, addComponents, addUtilities, theme }) {
      addComponents({
        '.btn': {
          backgroundColor: theme('colors.gray.400'),
          borderRadius: theme('borderRadius.lg'),
          paddingTop: theme('spacing.3'),
          paddingBottom: theme('spacing.3'),
          paddingRight: theme('spacing.6'),
          paddingLeft: theme('spacing.6'),
          textTransform: 'uppercase',
          fontWeight: theme('fontWeight.semibold'),
          whiteSpace: 'nowrap',
        },
        '.btn.btn-primary': {
          backgroundColor: theme('colors.blue.400'),
          color: theme('colors.white'),
        },
        '.btn:hover.btn-primary': {
          backgroundColor: theme('colors.blue.500'),
        },
        '.btn.btn-secondary': {
          backgroundColor: theme('colors.yellow.400'),
          color: theme('colors.blue.700')
        },
        '.btn:hover.btn-secondary': {
          backgroundColor: theme('colors.yellow.500'),
        },
        '.btn.btn-sm': {
          paddingTop: theme('spacing.2'),
          paddingBottom: theme('spacing.2'),
          paddingRight: theme('spacing.4'),
          paddingLeft: theme('spacing.4'),
          fontSize: theme('fontSize.sm')
        }
      })
    })
  ],
};
