module.exports = {
  theme: {
    extend: {},
  },
  variants: {
    borderColor: ['responsive', 'hover', 'focus', 'focus-within'],
    borderWidth: ['responsive', 'focus', 'hover'],
    zIndex: ['responsive', 'hover', 'focus'],
  },
  plugins: [
    require('@tailwindcss/custom-forms'),
  ]
}
