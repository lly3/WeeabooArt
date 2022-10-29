<template>
  <div class="flex flex-col xl:flex-row relative" v-if=is_loading>
    <div class="z-10 fixed top-0 left-0 w-full h-screen bg-white dark:bg-gray-800" v-if=overlay>
      <div class="h-full mx-auto p-6">
        <img v-if=post.image :src=imageURL(post.image) class="object-contain h-full block mx-auto drop-shadow-2xl">
      </div>
      <div class="absolute top-0 right-0 w-[40px] m-3 cursor-pointer dark:text-white" @click="() => overlay = false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12 6 6m6 6 6 6m-6-6 6-6m-6 6-6 6"/></svg>
      </div>
    </div>
    <div class="left-side xl:w-9/12 w-full z-0">
      <div id="default-carousel" class="mx-auto relative overflow-hidden bg-gradient-to-b from-gray-100 to-gray-50 dark:from-gray-500  dark:to-gray-800" data-carousel="static">
        <!-- Carousel wrapper -->
        <div id="carousel-wrapper" class="h-[65vh] max-h-[65vh] flex" data-slice-index=0>
          <!-- Item 1 -->
          <div class="duration-700 ease-in-out grow-0 shrink-0 basis-full z-10 my-6">
            <img v-if=post.image @click="() => overlay = true" :src=imageURL(post.image) class="block h-full cursor-pointer object-contain mx-auto drop-shadow-2xl">
          </div>
        </div>
      </div>
      <div class="p-4 flex font-bold dark:text-white lg:ml-28 lg:mr-0 md:mx-12">
        <div class="flex items-center sm:mr-8 mr-5 space-x-1.5 hover:text-greenlogo cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
          </svg>
          <p class="sm:block hidden">Add to favorites</p>
        </div>
        <div v-if=isOwner() class="flex items-center mr-2 space-x-1.5 hover:text-greenlogo cursor-pointer" @click=onEdit(post.id)>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
          </svg>
          <p>Edit</p>
        </div>
        <div class="ml-auto" />
        <div v-if=post.is_saleable class="mr-5">
          <button v-if=!bought @click=buyArtPost class="px-5 py-1 hover:bg-black hover:text-white dark:hover:text-black dark:hover:bg-white duration-200 ease-in-out border border-black dark:border-white rounded-3xl">
            Download for ${{ post.price }}
          </button>
          <button v-else @click=download class="px-5 py-1 hover:bg-black hover:text-white dark:hover:text-black dark:hover:bg-white duration-200 ease-in-out border border-black dark:border-white rounded-3xl">
            Download
          </button>
        </div>
        <div class="cursor-pointer hover:text-greenlogo pt-2" @click="() => overlay = true">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrows-angle-expand" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>
          </svg>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <p>{{ post.favorite_count }} <span class="sm:inline hidden">Favorites</span></p>
          </div>
          <div class="flex items-center space-x-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-fill" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            </svg>
            <p>{{comments.length}} <span class="sm:inline hidden"> Comments</span></p>
          </div>
          <div class="flex items-center space-x-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
            <p>{{ post.view_count }} <span class="sm:inline hidden">Views</span></p>
          </div>
        </div>

        <div class="flex space-x-2 text-xs" :v-for="tag in tags">
          <div class="border border-gray-300 dark:border-gray-600 dark:bg-gray-800 cursor-pointer rounded-md p-3 dark:text-white"  @click="() => this.$router.push(`/tags/${tag.id}`)">
              {{ tag.name }}
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
          <CommentCard :comments="{...comments}"  :key="commentKey"></CommentCard>
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
              <form class="flex"  @submit="onSubmitComment">
                  <div class="mr-3 sm:rounded-lg rounded">
                      <img :src=imageURL(this.auth_store.getImage) class="sm:h-[50px] sm:w-[55px] h-[30px] w-[35px] rounded-lg object-cover" />
                  </div>
                  <div class="w-full rounded-lg text-center bg-gray-100 dark:bg-gray-700 font-bold text-gray-500 dark:text-gray-300">
                      <div class="w-full bg-gray-200 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                          <div class="py-2 px-4 bg-gray-100 rounded-t-lg dark:bg-gray-800">
                              <label for="message" class="sr-only">Your comment</label>
                              <textarea v-model="message" ref="comment_section" maxlength="100" id="message" name="message" rows="4" class="px-0 bg-gray-100 w-full text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                          </div>
                          <div class="flex justify-between items-center py-2 px-3 border-t dark:border-gray-600">
                              <button type="submit" class="inline-flex ml-auto items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                  Comment
                              </button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
    <div class="right-side py-3 px-7 xl:w-3/12 w-full dark:text-white bg-gradient-to-t from-gray-100 to-white dark:from-gray-800 dark:to-gray-900">
      <p class="font-bold">More by {{ post.user_name }}</p>
      <div class="w-full mt-3">
        <Gallery :posts=more_by size='small' />
      </div>

      <p class="my-3 dark:text-gray-200 text-gray-500 font-bold">Suggested Collections</p>
      <div class="w-full h-screen mt-3 border">

      </div>
    </div>
  </div>
  <div v-else>
    <IsLoading />
  </div>
</template>

<script>

import { useAuthStore } from '@/stores/auth.js'
import { postAPI } from '@/services/api.js'
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
        const response = await postAPI.show(toParams.id)
        this.post = response.data.data
        await postAPI.more_by(this.post.user_id, 9, true)
          .then(res => this.more_by = res.data.data)
        await postAPI.collected(this.post.id)
          .then(res => this.bought = res.data);
      }
    )
  },
  async mounted() {
    try {
      let response = await postAPI.show(this.$route.params.id)
      this.post = response.data.data;
      response = await postAPI.more_by(this.post.user_id, 9, true)
      this.more_by = response.data.data;
      console.log(this.more_by);
      let comment_response = await this.$axios.get(`/comment/post/${this.$route.params.id}`)
      console.log(comment_response)
      console.log(response)
      this.comments = comment_response.data.data
      this.post = response.data.data;
      this.tags = response.data.data.tags;
      this.is_loading = true;
      console.log(this.post);
    } catch (e) {
      console.log(e);
      this.$router.push('/');
    }

    try {
      postAPI.collected(this.post.id)
        .then(res => this.bought = res.data);
    } catch (e) {
      console.log(e);
    }
  },
  data() {
    return {
      polling:'',
      post: {},
      more_by: {},
      suggested_collection_1: {},
      suggested_collection_2: {},
      suggested_collection_3: {},
      is_loading: false,
      overlay: false,
      bought: false,
      comments:{},
      tags:{},
      commentKey: 0

    }
  },
  methods: {
    async getData(){
        await this.$axios.get(`/comment/post/${this.$route.params.id}`)
            .then(response =>{
                this.comments = response.data.data
                console.log(this.comments)
            })
        this.$nextTick(()=>{
            this.$refs.comment_section.value=""
        })
    },
    onEdit(id) {
      return this.$router.push(`/post/edit/${id}`);
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
    buyArtPost() {
      if(this.auth_store.isAuthen == false)
        return this.$router.push('/login');

      try {
        postAPI.transaction(this.post.id)
          .then(res => {
            if(res.data.success)
              this.bought = true
          })
      } catch (e) {
        console.log(e)
      }
    },
    download() {
      postAPI.premiumDownload(this.post.id)
        .then((response) => {
          console.log();
          const url = URL.createObjectURL(new Blob([response.data], { type: response.headers["content-type"] }));
          var a = document.createElement("a");
          document.body.appendChild(a);
          a.style = "display: none";
          a.href = url;
          a.download = 'download_file.' + response.headers["content-type"].split("/")[1];
          a.click();
        })
    },

      async onSubmitComment(e){
          e.preventDefault()
          await this.$axios.post(`/comment`, {
              message: this.message,
              post_id: this.post.id,
          }, {
              headers: {
                  Authorization: `Bearer ${localStorage.getItem("jwt_token")}`
              }
          })
          await this.getData()
          this.$nextTick(()=>{
              this.$refs.comment_section.value=""
          })


      },
      // onClickTag(tag){
      //     this.$router.push(`tags/${tag.id}`)
      // },
  },

  components: {
    IsLoading,
    Gallery,
    CommentCard
  }
}
</script>
