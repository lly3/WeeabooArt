<template>
  <div class="flex flex-col xl:flex-row">
    <div class="left-side xl:w-9/12 w-full">
      <div id="default-carousel" class="mx-auto relative overflow-hidden bg-gradient-to-b from-gray-100 to-gray-50 dark:from-gray-500  dark:to-gray-800" data-carousel="static">
        <!-- Carousel wrapper -->
        <div id="carousel-wrapper" class="h-[70vh] max-h-[70vh] flex" data-slice-index=0>
          <!-- Item 1 -->
          <div class="duration-700 ease-in-out grow-0 shrink-0 basis-full z-10 my-5">
            <img src="http://localhost/83106977_p0.jpg" class="block h-full object-contain mx-auto">
          </div>
        </div>
      </div>
      <div class="p-4 flex justify-between border">
        <div class="flex dark:text-white">
          <p>Add to favorites</p>
        </div>
        <div class="flex dark:text-white" @click=onEdit(1)>
          <p>Edit</p>
        </div>
      </div>

      <div class="md:w-9/12 w-5/6 mx-auto my-3 space-y-3 relative">
        <div class="mb-6 space-y-2">
          <div class="flex items-center">
            <img src="" class="w-[60px] h-[60px] rounded-xl border" />
            <div class="flex flex-col ml-3">
              <p class="text-3xl font-bold dark:text-white">{{ post.title }}</p> 
              <p class="dark:text-white">{{ }}</p>
            </div>
          </div>   
        </div>
        <div class="flex space-x-5">
          <p class="dark:text-white">Favorites</p>
          <p class="dark:text-white">Comments</p>
          <p class="dark:text-white">Views</p>
        </div>
        <div class="flex space-x-2">
          <div class="border rounded-lg p-3 text-sm dark:text-white">
            Tag 1
          </div>
          <div class="border rounded-lg p-3 text-sm dark:text-white">
            Tag 2
          </div>
          <div class="border rounded-lg p-3 text-sm dark:text-white">
            Tag 3
          </div>
        </div>
        <div class="break-all dark:text-white">
          descriptions aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        </div>
        <div>
          <p class="font-bold dark:text-white">Image details</p>
          <div class="dark:text-white">
            Image size: 
          </div>
        </div>
        <div class="mt-6 text-sm dark:text-white">
          © 2022 TudorPopa
        </div>
        <div class="xl:absolute xl:top-0 xl:right-0 static text-right text-sm dark:text-white">
          Published: Jul 30, 2022
        </div>
        <div>
          <p class="font-bold dark:text-white">Comments</p>
          <div class="w-full h-[300px] border mt-3">
            
          </div>
        </div>
      </div>
    </div>
    <div class="right-side p-5 xl:w-3/12 w-full dark:text-white">
      <p>More by _____</p>
      <div class="w-full h-[250px] mt-3 border">
        
      </div>

      <p class="my-3 dark:text-white">Suggested Collections</p>
      <div class="w-full h-screen mt-3 border">
        
      </div>
    </div>
  </div>
</template>

<script>
export default {
  async mounted() {
    try {
      const response = await this.$axios.get(`/post/${this.$route.params.id}`);
      this.post = response.data;
      console.log(this.post);
    } catch (e) {
      console.log(e.message);
    }
  },
  data() {
    return {
      post: {},
    }
  },
  methods: {
    onEdit(id) {
      return this.$router.push(`/post/edit/${id}`);
    },
  },
}
</script>
