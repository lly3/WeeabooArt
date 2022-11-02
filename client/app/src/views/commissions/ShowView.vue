<template>
  <div class="flex flex-col xl:flex-row relative" v-if=is_loading>
    <div class="z-10 fixed top-0 left-0 w-full h-screen bg-white dark:bg-gray-800 hidden" id="overlay">
      <div v-for="image in images" :key=image.id class="h-full mx-auto p-6 hidden" :id="image.id">
        <img :src=imageURL(image.path) class="object-contain h-full block mx-auto drop-shadow-2xl"> 
      </div>
      <div class="absolute top-0 right-0 w-[40px] m-3 cursor-pointer dark:text-white" @click="closeOverlay">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12 6 6m6 6 6 6m-6-6 6-6m-6 6-6 6"/></svg>
      </div>
    </div>
    <div class="left-side xl:w-9/12 w-full z-0">
      <div id="default-carousel" class="mx-auto relative overflow-hidden bg-gradient-to-b from-gray-100 to-gray-50 dark:from-gray-500  dark:to-gray-800" data-carousel="static">
        <!-- Carousel wrapper -->
        <div id="carousel-wrapper" class="h-[65vh] max-h-[65vh] flex" data-slice-index=0>
          <!-- Item 1 -->
          <div v-for="image in images" :key=image.id class="duration-700 ease-in-out grow-0 shrink-0 basis-full z-10 my-6">
            <img @click="openOverlay(image.id)" :src=imageURL(image.path) class="block h-full cursor-pointer object-contain mx-auto drop-shadow-2xl"> 
          </div>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="prev-button" @click=prevImage>
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-gray-800 dark:bg-gray-800/30 group-hover:bg-gray-800/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
          </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" id="next-button" @click=nextImage>
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-gray-800 dark:bg-gray-800/30 group-hover:bg-gray-800/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
          </span>
        </button>
      </div>
      <div class="p-4 flex font-bold dark:text-white lg:ml-28 lg:mr-0 md:mx-12">
        <div v-if=isOwner() class="flex items-center mr-2 space-x-1.5 hover:text-greenlogo cursor-pointer" @click=onEdit(post.id)>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
          </svg>
          <p>Edit</p>
        </div>
        <div class="ml-auto"></div>
        <div class="flex items-center mr-2 md:text-lg border-r border-black pr-2">
          <p>${{ post.price }}</p>
        </div>
        <div class="mr-5">
          <button @click=chat class="flex justify-center px-5 py-1 hover:bg-black hover:text-white dark:hover:text-black dark:hover:bg-white duration-200 ease-in-out border border-black dark:border-white rounded-3xl">
            Order Commission
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-fill ml-2" viewBox="0 0 16 16">
              <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z"/>
            </svg>
          </button>
        </div>

      </div>

      <div class="md:w-9/12 w-5/6 mx-auto my-3 space-y-3 relative">
        <div class="mb-6 space-y-2">
          <div class="flex items-center">
            <img :src=imageURL(post.user_image) class="w-[60px] h-[60px] rounded-xl object-cover" />
            <div class="flex flex-col ml-3 w-full">
              <p class="text-3xl font-bold dark:text-white xl:w-2/3 w-full break-all">{{ post.title }}</p> 
              <p class="dark:text-white text-lg">by <span class="font-bold underline cursor-pointer hover:text-greenlogo">{{ post.user_name }}</span></p>
            </div>
          </div>   
        </div>
        <div class="flex space-x-5 text-gray-500 dark:text-gray-300">
          <div class="flex items-center space-x-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-fill" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            </svg>
            <p>{{ comments.length }} <span class="sm:inline hidden">Comments</span></p>
          </div>
          <div class="flex items-center space-x-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
            <p>{{ post.view_count }} <span class="sm:inline hidden">Views</span></p>
          </div>
        </div>
        <div class="whitespace-pre-wrap break-all dark:text-white">
          {{ post.description }}
        </div>
        <div class="mt-6 text-sm dark:text-white dark:text-gray-200 text-gray-500">
          © 2022 {{ post.user_name }}
        </div>
        <div class="xl:absolute xl:top-0 xl:right-0 static text-right text-sm dark:text-gray-200 text-gray-500">
          Published: {{ post.published }}
        </div>
        <div>
          <p class="font-bold dark:text-white">Comments</p>
          <div class="w-full h-[300px] mt-3" v-if=!auth_store.isAuthen>
            <div class="flex">
              <div class="mr-3 rounded-lg">
                <img :src=defaultImage() class="sm:h-[50px] sm:w-[55px] h-[30px] w-[35px] rounded-lg object-cover" /> 
              </div>
              <div class="w-full p-6 text-center bg-gray-100 dark:bg-gray-700 font-bold text-gray-500 dark:text-gray-300">
                <span class="text-black dark:text-white hover:text-greenlogo dark:hover:text-greenlogo cursor-pointer" @click="() => this.$router.push('/register')">Join the community</span> to add your comment. Already a deviant? <span class="text-black dark:text-white dark:hover:text-greenlogo hover:text-greenlogo cursor-pointer" @click="() => this.$router.push('/login')">Log In</span>
              </div>
            </div>
          </div>
          <div v-else class="w-full mt-3">
            <div class="flex">
              <div class="mr-3 sm:rounded-lg rounded">
                <img :src=imageURL(this.auth_store.getImage) class="sm:h-[50px] sm:w-[55px] h-[30px] w-[35px] rounded-lg object-cover" /> 
              </div>
              <form @submit=submitComment class="w-full rounded-lg text-center bg-gray-100 dark:bg-gray-700 font-bold text-gray-500 dark:text-gray-300">
                <div class="w-full bg-gray-200 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                  <div class="py-2 px-4 bg-gray-100 rounded-t-lg dark:bg-gray-800">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea v-model=message id="comment" rows="3" class="px-0 bg-gray-100 w-full text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                  </div>
                  <div class="flex justify-between items-center py-2 px-3 border-t dark:border-gray-600">
                    <button type=submit class="inline-flex ml-auto items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                      Comment
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="space-y-2">
          <CommentCard v-for="comment in comments" :comment="comment" :key="comment.id"></CommentCard>
        </div>
      </div>
    </div>
    <div class="right-side py-3 px-7 xl:w-3/12 w-full dark:text-white bg-gradient-to-t from-gray-100 to-white dark:from-gray-800 dark:to-gray-900">
      <p class="font-bold">More by {{ post.user_name }}</p>
      <div class="w-full mt-3">
        <Gallery :posts=more_by size='small' model='commission' />
      </div>
    </div>
  </div>
  <div v-else>
    <IsLoading />
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js'
import { commissionAPI, commentAPI } from '@/services/api.js'
import IsLoading from '@/components/IsLoading.vue'
import Gallery from '@/components/GalleryCardView.vue'
import CommentCard from '@/components/CommentCard.vue'

export default {
  setup() {
    const auth_store = useAuthStore()
    return { auth_store }
  },
  created() {
    this.$watch(
      () => this.$route.params,
      async (toParams, previousParams) => {
        const response = await commissionAPI.show(toParams.id)
        this.post = response.data.data
        this.images = this.post.images
        await commissionAPI.more_by(this.post.user_id, 12, true)
          .then(res => this.more_by = res.data.data)
        this.calculateTranslate(0)
      }
    )
  },
  async mounted() {
    try {
      let response = await commissionAPI.show(this.$route.params.id);
      this.post = response.data.data;
      console.log(this.post);
      this.images = this.post.images;
      this.comments = this.post.comments;
      response = await commissionAPI.more_by(this.post.user_id, 12, true)
      this.more_by = response.data.data
      this.is_loading = true;
      console.log(response);
      console.log(this.post);
    } catch (e) {
      console.log(e);
      this.$router.push('/');
    }

  },
  data() {
    return {
      post: {},
      more_by: {},
      images: {},
      comments: {},
      message: null,
      is_loading: false,
      overlay: false,
    }
  },
  methods: {
    onEdit(id) {
      return this.$router.push(`/commission/edit/${id}`);
    },
    isOwner() {
      return this.auth_store.getEmail == this.post.user_email
    },
    imageURL(path) {
      return 'http://localhost/images/' + path
    },
    defaultImage() {
      return 'http://localhost/image.png'
    },
    nextImage() {
      console.log('hello');
      const wrapper = document.getElementById('carousel-wrapper');
      const sliceIndex = parseInt(wrapper.getAttribute('data-slice-index'));
      if(sliceIndex < wrapper.children.length - 1) {
        this.calculateTranslate(sliceIndex + 1);
      }
    },
    prevImage() {
      const wrapper = document.getElementById('carousel-wrapper');
      const sliceIndex = parseInt(wrapper.getAttribute('data-slice-index'));
      if(sliceIndex > 0 ) {
        this.calculateTranslate(sliceIndex - 1);
      }
    },
    calculateTranslate(sliceIndex) {
      console.log('call');
      const wrapper = document.getElementById('carousel-wrapper');
      wrapper.setAttribute('data-slice-index', sliceIndex);
      wrapper.style.cssText = "transform: translateX(-" + (sliceIndex * 100) + "%); transition: ease-in-out transform .7s;";
    },
    openOverlay(id) {
      const container = document.getElementById('overlay')
      const image = document.getElementById(id)
      container.classList.remove('hidden')
      image.classList.remove('hidden')
    },
    closeOverlay() {
      const container = document.getElementById('overlay')
      for(let i = 0; i < container.children.length - 1; i++) {
        container.children[i].classList.add('hidden')
      }
      container.classList.add('hidden')
    },
    async submitComment(e) {
      e.preventDefault()

      const response = await commentAPI.commissionComment(this.message, this.post.id)
      console.log(response);
      const comment = response.data.data
      this.comments = { ...this.comments, comment }

      this.message = null
    }
  },
  components: {
    IsLoading,
    Gallery,
    CommentCard
  }
}
</script>
