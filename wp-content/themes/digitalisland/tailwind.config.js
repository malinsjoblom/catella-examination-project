const defaults = require('tailwindcss/defaultTheme')
const {colors, screens} = defaults


const settings = {
  future: {
    // removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
  purge: {
    enabled: true,
    content: [
      "./functions/template-functions.php",
      "./templates/**/*.php",
      './*.php',
      './templates/**/*.php',
      './woocommerce/**/*.php',
      './woocommerce-bookings/**/*.php'
    ],
    whitelist: [
      'visible', 'hidden'
    ],
  },
  variants: {},
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ],
  theme: {
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1400px',
      // '2xl': '1536px',
    },
    container: {
      padding: {
        DEFAULT: '1rem',
        sm: '0',
      },
    },
    extend: {
      spacing: {
        13: "3.25rem",
        // 14: "3.5rem",
        15: "3.75rem",
        // 16: "4rem",
        17: "4.25rem",
        18: "4.50rem",
        19: "4.75rem",
        224: '56rem',
        164: '48rem'
      },
      colors: {
          'darkest-purple': '#614168',
          'dark-purple': '#9C87A8',
          'purple': '#BFB3CA',
          'light-purple': '#E3DDE8',
          'lighter-purple': '#EEEAF2',
          'dark-green': '#005A5A',
          'lightest-green': '#EAF0EF',

      },
    }
  },
}

module.exports = settings;
