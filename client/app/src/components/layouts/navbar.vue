<template>
  <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-900 ease-out duration-300">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
      <button @click="() => this.$router.push('/')" class="flex items-center ">
        <img src="https://i.kym-cdn.com/photos/images/original/001/935/776/70f.gif" class="mr-3 h-6 sm:h-9" alt="Weeaboo Logo" />
        <div class="flex flex-col items-start">
          <p class="text-xl font-semibold whitespace-nowrap dark:text-white">Weeaboo</p>
          <p class="text-xl font-semibold whitespace-nowrap dark:text-white">Art</p>
        </div>
      </button>
      <div class="flex items-center md:order-2 space-x-3">
        <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        </button>
        
        <div v-if=!auth_store.isAuthen class="flex flex-row space-x-3">
          <button @click="() => this.$router.push('/register')" class="font-semibold dark:text-white p-2 dark:hover:text-greenlogo hover:text-greenlogo duration-200 ease-in">Join</button>
          <button @click="() => this.$router.push('/login')" class="font-semibold dark:text-white p-2 dark:hover:text-greenlogo hover:text-greenlogo duration-200 ease-in">Login</button>
        </div>

        <div>
          <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-lg md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <img v-if=this.auth_store.isAuthen class="w-8 h-8 rounded-md object-cover" :src=imageURL(this.auth_store.getImage)>
            <img v-else class="w-8 h-8 rounded-md object-cover" :src=defaultImage()>
          </button>

          <!-- Dropdown menu -->
          <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
            <div>
              <div @click=toggleDarkMode class="flex items-center cursor-pointer py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                <p class="mr-8">Dark Mode</p>
                <svg id='toggle-off' xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                  <path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4h3zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5z"/>
                </svg>
                <svg id='toggle-on' xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
                  <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                </svg>
              </div>
            </div>
            <div v-if=auth_store.isAuthen>
              <div class="py-3 px-4">
                <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
                <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
              </div>
              <ul class="py-1" aria-labelledby="user-menu-button">
                <li>
                  <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                </li>
                <li>
                  <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                </li>
                <li>
                  <button @click="() => this.$router.push('/logout')" class="block w-full text-left py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</button>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <MyButton title='+ Submit' textColor='black' :action="() => this.$router.push('/post/create')"/>
      </div>
      <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
        <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 ease-out duration-300">
          <li>
            <button @click="() => this.$router.push('/')" class="block w-full text-left py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</button>
          </li>
          <li>
            <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
          </li>
          <li>
            <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
          </li>
          <li>
            <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Pricing</a>
          </li>
          <li>
            <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template> 

<script>
import MyButton from '@/components/MyButton.vue'
import { useAuthStore } from '@/stores/auth.js'

export default {
  setup() {
    const auth_store = useAuthStore()
    return { auth_store }
  },
  components: {
    MyButton
  },
  async mounted() {
      if(localStorage.theme === 'dark') {
        document.getElementById('toggle-on').style.display = 'block'
        document.getElementById('toggle-off').style.display = 'none'
      }
      else {
        document.getElementById('toggle-on').style.display = 'none'
        document.getElementById('toggle-off').style.display = 'block'
      }
  },
  methods: {
    toggleDarkMode() {
      if(localStorage.theme === 'dark') {
        document.documentElement.classList.remove('dark')
        localStorage.theme = 'light'

        document.getElementById('toggle-on').style.display = 'none'
        document.getElementById('toggle-off').style.display = 'block'
      }
      else {
        document.documentElement.classList.add('dark')
        localStorage.theme = 'dark'

        document.getElementById('toggle-on').style.display = 'block'
        document.getElementById('toggle-off').style.display = 'none'
      }
    },
    imageURL(path) {
      return 'http://localhost/images/' + path
    },
    defaultImage() {
      return 'http://localhost/image.png'
    }
  }
}
</script>
