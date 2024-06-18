/** @type {import('tailwindcss').Config} */
    export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
    ],
    theme: {
    extend: {},
    },
    plugins: [
      //require('@tailwindcss/forms'),
      require('@tailwindcss/typography'),
      require('daisyui')
    ],
    // daisyUI config (optional - here are the default values)
    daisyui: {
        themes: ['fantasy'], // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
        darkTheme: "fantasy", // name of one of the included themes for dark mode
        base: true, // applies background color and foreground color for root element by default
        styled: true, // include daisyUI colors and design decisions for all components
        utils: true, // adds responsive and modifier utility classes
        prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
        logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
        themeRoot: ":root", // The element that receives theme color CSS variables
    }
}

