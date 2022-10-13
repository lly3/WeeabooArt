<template>
    <div class="bg-black">
        <section class="overflow-hidden text-gray-700">
            <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" v-if="haveMore6Posts">
                <h1 class="text-white py-5">Most likes</h1>
                <div class="flex flex-wrap -m-1 md:-m-2">
                    <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                        <a :href="'http://localhost/images/' + posts_mostLiked[0].image.path.toString()" class="p-1 md:p-2 w-1/2">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[0].image.path.toString()">
                        </a>
                        <a href="#" class="p-1 md:p-2 w-1/2">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[1].image.path.toString()">
                        </a>
                        <a href="#" class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[2].image.path.toString()">
                        </a>
                    </div>
                    <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                        <a href="#" class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[3].image.path.toString()">
                        </a>
                        <a href="#" class="w-1/2 p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[4].image.path.toString()">
                        </a>
                        <a href="#" class="w-1/2 p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[5].image.path.toString()">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="overflow-hidden text-gray-700">
            <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" v-if="haveMore6Posts">
                <h1 class="text-white py-5">Most View</h1>
                <div class="flex flex-wrap -m-1 md:-m-2">
                    <div class="flex flex-wrap w-1/2" v-if="mostViews">
                        <a href="#" class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[0].image.path.toString()">
                        </a>
                        <a href="#" class="p-1 md:p-2 w-1/2">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[1].image.path.toString()">
                        </a>
                        <a href="#" class="p-1 md:p-2 w-1/2">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="http://localhost/images/202210100035WIN_20220720_14_18_33_Pro.jpg">
                        </a>
                    </div>
                    <div class="flex flex-wrap w-1/2">
                        <a href="#" class="w-1/2 p-1 md:p-2" v-if="mostViews">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp">
                        </a>
                        <a href="#" class="w-1/2 p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp">
                        </a>
                        <a href="#" class="w-full p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <gallery-card-view :posts="posts"></gallery-card-view>
        </section>
    </div>
<!--    <div class="overflow-auto">-->
<!--        <b-pagination-->
<!--            v-model="currentPage"-->
<!--            :total-rows="rows"-->
<!--            :per-page="perPage"-->
<!--            first-number-->
<!--        ></b-pagination>-->
<!--    </div>-->

</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";

import {onBeforeMount} from "vue"

export default {
    data () {
        return {
            posts: Object,
            posts_mostLiked: [],
            posts_mostViewed: [],
            error: null,
            // first-number: 1,
            // rows: 0,
            // perpage: 15,
        }
    },
    // async created() {
    //     try{
    //         const response_mostLiked = await this.$axios.post('/post/mostLiked');
    //         this.posts_mostLiked = response_mostLiked.data
    //         // this.posts_mostLiked.push(response_mostLiked.data)
    //         const response_mostViewed = await this.$axios.post('/post/mostViewed');
    //         this.posts_mostViewed = response_mostViewed.data
    //     } catch (error) {
    //         console.log(error)
    //         this.error = error.message
    //     }
    // },
    props: {
        post: Object,
    },
    components: {
        GalleryCardView
    },
    computed: {
        mostLikes() {
            return this.posts_mostLiked.length
        },
        mostViews() {
            return this.posts_mostViewed.length
        },
        havePosts() {
            if (this.posts.length > 0) {
                return true
            } else {
                return false
            }
        },
        haveMore6Posts() {
            if (this.posts.length > 5) {
                return true
            } else {
                return false
            }
        },
    },

    async mounted() {
        try {
            this.error = null
            const response_mostLiked = await this.$axios.post('/post/mostLiked');
            this.posts_mostLiked = response_mostLiked.data
            const response_mostViewed = await this.$axios.post('/post/mostViewed');
            this.posts_mostViewed = response_mostViewed.data
            const response = await this.$axios.get('/post');
            this.posts = response.data.data

        } catch (error) {
            console.log(error)
            this.error = error.message
        }
    }

}
</script>
