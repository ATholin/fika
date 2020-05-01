module.exports = {
    theme: {
    extend: {},
    },
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.vue',
    ],
    variants: {},
    plugins: [
      require('@tailwindcss/custom-forms'),
    ],
}
