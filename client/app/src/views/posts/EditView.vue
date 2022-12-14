<template>
  <div>
    <div id="default-carousel" class="mx-auto relative overflow-hidden bg-gradient-to-b from-gray-100 to-gray-50 dark:from-gray-500  dark:to-gray-800" data-carousel="static">
      <!-- Carousel wrapper -->
      <div id="carousel-wrapper" class="h-[70vh] max-h-[70vh] flex" data-slice-index=0>
        <!-- Item 1 -->
        <div class="duration-700 ease-in-out grow-0 shrink-0 basis-full z-10 my-5">
          <img v-if="image.path && imageFile == null" :src=imageURL(image.path) class="block h-full object-contain mx-auto">
          <img v-if=imageFile :src=imageFileURL class="block h-full object-contain mx-auto">
        </div>
      </div>
    </div>
    <div class="xl:w-3/6 md:w-4/6 w-5/6 mx-auto">
      <form>
        <div class="my-3">
          <input class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                 type="file"
                 id="browse"
                 name="image"
                 @change=previewImage
                 >
        </div>
        <div>
          <div class="mb-6 space-y-2">
            <label for="title" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-300">Art Title</label>
            <input v-model=post.title type="text" id="title" name="title" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <label for="description" class="block mb-2 text-xl  font-medium text-gray-900 dark:text-gray-300">Description</label>
            <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
              <div class="py-2 px-4 bg-white rounded-t-lg dark:bg-gray-800">
                <textarea v-model=post.description id="description" name="description" rows="4" class="px-0 w-full text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Introduce your art, Tell the backstory, add some intriguing accompanying text, or simply give any extra information you'd like them to know." required></textarea>
              </div>
            </div>
            <label for="tags" class="block mb-2 text-xl  font-medium text-gray-900 dark:text-gray-300">Add tags</label>
            <input v-model="tags" type="text" required id="tags" name="tags" placeholder="E.g.: rose, watercolor, painting, fanart, tutorial, photoshop, poetry" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <div v-if=post.is_saleable>
              <label for="price" class="block mb-2 text-xl  font-medium text-gray-900 dark:text-gray-300">Price</label>
              <input v-model=post.price type="number" step=".01" min="0" id="price" name="price" placeholder="Enter your price here" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
          </div>
          <div class="flex items-center space-x-2 justify-end py-2 px-3 dark:border-gray-600">
            <button @click=onDelete class="inline-flex items-center py-2.5 px-4 text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
              Delete Post
            </button>
            <button @click=onEdit class="inline-flex items-center py-2.5 px-4 text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
              Edit Post
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js'
import { postAPI, imageAPI } from '@/services/api.js'

export default {
  setup() {
    const auth_store = useAuthStore()
    return { auth_store }
  },
  async mounted() {
    try {
      const response = await postAPI.editView(this.$route.params.id)
      this.post = response.data.post;
      this.tags = response.data.tags;
      this.image = this.post.image;
      console.log(this.post);

      if (!this.auth_store.isAuthen) {
        return this.$router.push('/login')
      }
      else if(this.auth_store.getEmail != this.post.user.email) {
        return this.$router.push(`/post/${this.$route.params.id}`)
      }
    } catch (e) {
      console.log(e.message);
      this.$router.push('/');
    }
  },
  data() {
    return {
      post: {},
      image: {},
      tags: String,
      imageFile: null,
      imageFileURL: '',
    }
  },
  methods: {
    async onEdit(e) {
      e.preventDefault();

      try {
        if(this.imageFile != null) {
          const imageID = await imageAPI.uploadImage(this.imageFile)
          await postAPI.edit(this.post.id, { ...this.post, imageID, tags: this.tags })
        }
        await postAPI.edit(this.post.id, { ...this.post, tags: this.tags })

        this.$router.back()
      } catch (e) {
        console.log(e);
      }
    },
    async onDelete(e) {
      e.preventDefault();

      try {
        if (confirm('Are you sure?')) {
          await postAPI.delete(this.post.id)

          this.$router.back()
        }
      } catch (e) {
        console.log(e);
      }
    },
    previewImage(e) {
      this.imageFile = e.target.files[0]
      this.imageFileURL = URL.createObjectURL(e.target.files[0])
    },
    imageURL(path) {
      return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
    },
  },
}

</script>
