<template>
    <div class="">
          <div class="h-[40vh] relative">
            <div class="absolute overflow-hidden w-full h-[40vh] bg-profile-banner-light dark:bg-profile-banner-dark bg-center">
            </div>
            <div class="absolute md:bottom-5 md:left-20 md:p-0 bottom-0 left-0 pl-5 pb-5 flex items-center container">
              <img :src=imageURL class="w-[100px] h-[100px] rounded-md object-cover" />
              <div class="flex flex-col ml-3"> 
                <p class="inline md:text-5xl text-3xl font-bold break-all dark:text-white">{{ this.author.name }}</p> 
                <p class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 font-semibold object-cover w-40 dark:text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                  </svg> {{ this.author.date_of_birth }}
                </p>
              </div>

            </div>
          </div>   
        </div>
</template>

<script>
export default {
  computed: {
    imageURL: function ()  {
      return import.meta.env.VITE_BACKEND_IMG_URL + '/' + this.author.image
    },
  },
  props: {
    author: Object
  }
}
</script>
