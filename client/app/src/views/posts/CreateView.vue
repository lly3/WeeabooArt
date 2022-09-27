<template>
  <div id="default-carousel" class="mx-auto relative overflow-hidden bg-gradient-to-b from-gray-100 to-gray-50 dark:from-gray-500  dark:to-gray-800" data-carousel="static">
    <!-- Carousel wrapper -->
    <div id="carousel-wrapper" class="h-[70vh] max-h-[70vh] flex" data-slice-index=0>
      <!-- Item 1 -->
      <div class="duration-700 ease-in-out grow-0 shrink-0 basis-full z-10 my-5">
        <img :src="imageURL" class="block h-full object-contain mx-auto">
      </div>
    </div>
  </div>
  <div class="xl:w-3/6 md:w-4/6 w-5/6 mx-auto">
    <form @submit="onSubmit">
      <div class="my-3">
        <input class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
               type="file"
               id="browse"
               name="image" 
               @change="previewImage"
               >
      </div>
      <div>
        <div class="mb-6 space-y-2">
          <label for="title" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-300">Art Title</label>
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
          <div class="flex items-center mb-4">
            <input id="is_salable" name="is_salable" type="checkbox" :value="is_toggle" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @click="onToggle()">
            <label for="is_salable" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Make this post Premium Download</label>
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
</template>

<script>
export default {
  data() {
    return {
      title: '',
      description: '',
      tags: '',
      price: 0,
      image: null,
      imageURL: null,
      is_toggle: false,
    }
  },
  methods: {
    onToggle() {
      this.is_toggle = !this.is_toggle
    },
    async onSubmit(e) {
      e.preventDefault();
      
      try {
        await this.$axios.post('/post', {
          title: this.title,
          description: this.description,
          tags: this.tags,
          image: this.image,
          premium_download: this.is_toggle,
          price: this.price,
        })
      } catch (e) {
        console.log(e.message);
      }
    },
    previewImage(e) {
      this.image = e.target.files[0]
      this.imageURL = URL.createObjectURL(e.target.files[0])
    },
  },
}

</script>
