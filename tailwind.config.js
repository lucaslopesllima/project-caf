/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                montserrat: ['Montserrat', 'sans-serif']
            }
        },
    },
    daisyui: {
        themes: ["light", "dark", "cupcake"],
      },
    plugins: [
        require('daisyui')
    ],
};
