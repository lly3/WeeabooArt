/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
      colors: {
          greenlogo: '#01e59b',
          secondarybg: '#06070d',
          secondaryfont: '#b1b1b9',
      },
    extend: {},

  },
  plugins: [
    require('flowbite/plugin')
  ],
}
