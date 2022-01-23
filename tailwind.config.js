const plugin = require("tailwindcss/plugin");

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    variants: {
        extend: {},
    },
    plugins: [
        plugin(
            function ({addComponents}) {
                addComponents(
                    {
                        '.btn': {
                            padding: '.5rem 1rem',
                            borderRadius: '.25rem',
                            fontWeight: '600',
                        },
                        '.btn-blue': {
                            backgroundColor: '#3490dc',
                            color: '#fff',
                        },
                        '&:hover': {
                            backgroundColor: '#2779bd'
                        },
                        '.btn-red': {
                            backgroundColor: '#e3342f',
                            color: '#fff',
                        },
                        '&:hover': {
                            backgroundColor: '#cc1f1a'
                        }
                    }
                )
            }
        )
    ],
}
