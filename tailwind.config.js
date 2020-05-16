module.exports = {
    theme: {
        extend: {
            colors: {
                'brand-500': '#f50057',
                'brand-700': '#c60045',
            }
        },
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
