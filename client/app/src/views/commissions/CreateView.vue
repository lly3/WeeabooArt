<template>
  <div>
    <div id="default-carousel" class="mx-auto relative overflow-hidden bg-gradient-to-b from-gray-100 to-gray-50 dark:from-gray-500  dark:to-gray-800" data-carousel="static">
      <!-- Carousel wrapper -->
      <div id="carousel-wrapper" class="h-[70vh] max-h-[70vh] flex" data-slice-index=0>
        <!-- Item 1 -->
        <div v-for="image in images" :key=image.id class="duration-700 ease-in-out grow-0 shrink-0 basis-full z-10 my-5">
          <img :src=imageURL(image) class="block h-full object-contain mx-auto">
        </div>
      </div>
      <!-- Slider controls -->
      <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="prev-button">
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-gray-800 dark:bg-gray-800/30 group-hover:bg-gray-800/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
          <span class="sr-only">Previous</span>
        </span>
      </button>
      <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="next-button">
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-gray-800 dark:bg-gray-800/30 group-hover:bg-gray-800/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          <span class="sr-only">Next</span>
        </span>
      </button>
    </div>
    <div class="xl:w-3/6 md:w-4/6 w-5/6 mx-auto">
      <form @submit="onSubmit">
        <div class="my-3">
          <input class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                 type="file"
                 id="browse"
                 name="image"
                 @change="previewImage"
                 multiple
                 >
        </div>
        <div>
          <div class="mb-6 space-y-2">
            <label for="title" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-300">Commission Title</label>
            <input v-model="title" type="text" id="title" name="title" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <label for="description" class="block mb-2 text-xl  font-medium text-gray-900 dark:text-gray-300">Description</label>
            <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
              <div class="py-2 px-4 bg-white rounded-t-lg dark:bg-gray-800">
                <textarea v-model="description" id="description" name="description" rows="4" class="px-0 w-full text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Introduce your art, Tell the backstory, add some intriguing accompanying text, or simply give any extra information you'd like them to know." required></textarea>
              </div>
            </div>
            <label for="tags" class="block mb-2 text-xl  font-medium text-gray-900 dark:text-gray-300">Add tags</label>
            <input v-model="tags" type="text" id="tags" name="tags" placeholder="E.g.: rose, watercolor, painting, fanart, tutorial, photoshop, poetry" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <div v-if="is_toggle" >
              <label for="price" class="block mb-2 text-xl  font-medium text-gray-900 dark:text-gray-300">Price</label>
              <input v-model="price" type="number" step=".01" min="0" id="price" name="price" placeholder="Enter your price here" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
          </div>
          <div class="flex items-center justify-end py-2 px-3 dark:border-gray-600">
            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
              Submit now
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js'

function calculateTranslate(sliceIndex) {
  const wrapper = document.getElementById('carousel-wrapper');
  wrapper.setAttribute('data-slice-index', sliceIndex);
  wrapper.style.cssText = "transform: translateX(-" + (sliceIndex * 100) + "%); transition: ease-in-out transform .7s;";
}

export default {
  setup() {
    const auth_store = useAuthStore()
    return { auth_store }
  },
  mounted() {
    if(!this.auth_store.isAuthen)
      return this.$router.push('/login')

    document.getElementById('next-button').addEventListener('click', () => {
      console.log('hello');
      const wrapper = document.getElementById('carousel-wrapper');
      const sliceIndex = parseInt(wrapper.getAttribute('data-slice-index'));
      if(sliceIndex < wrapper.children.length - 1) {
        calculateTranslate(sliceIndex + 1);
      }
    })
    document.getElementById('prev-button').addEventListener('click', () => {
      const wrapper = document.getElementById('carousel-wrapper');
      const sliceIndex = parseInt(wrapper.getAttribute('data-slice-index'));
      if(sliceIndex > 0 ) {
        calculateTranslate(sliceIndex - 1);
      }
    })
    
  },
  data() {
    return {
      title: '',
      description: '',
      tags: '',
      images: null,
      is_toggle: false,
    }
  },
  methods: {
    onToggle() {
      this.is_toggle = !this.is_toggle
    },
    async onSubmit(e) {
      e.preventDefault();

      const imagesID = await this.uploadImages()
      const response = await this.$axios.post('/commission', {
        title: this.title,
        description: this.description,
        tags: this.tags,
        imagesID: imagesID,
      }, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("jwt_token")}`
        }
      })
      const commissionID = response.data.commission_id
      this.$router.push(`/commission/${commissionID}`)
    },
    async uploadImages() {
      const formData = new FormData();
      for (let i = 0; i < this.images.length; i++) {
        formData.append('images[]', this.images[i])
      }
      const response = await this.$axios.post('/images', formData, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("jwt_token")}`
        }
      })
      console.log(response);
      return response.data.data;
    },
    previewImage(e) {
      calculateTranslate(0);
      this.images = e.target.files
    },
    imageURL(image) {
      return URL.createObjectURL(image)
    }
  },
}
</script>
