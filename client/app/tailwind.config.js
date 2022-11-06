/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    colors: {
      greenlogo: '#01e59b',
      secondarybg: '#06070d',
      secondaryfont: '#b1b1b9',
    },
    extend: {
      backgroundImage: {
        'profile-banner-light': "linear-gradient(to bottom, rgba(0,0,0,0), rgba(255,255,255,1)), url('/profile_banner.jpg')",
        'profile-banner-dark': "linear-gradient(to bottom, rgba(0,0,0,0), rgba(31,41,55,255)), url('/profile_banner.jpg')",
      },
    },

  },
  plugins: [
    require('flowbite/plugin')
  ],
  darkMode: 'class',
}
