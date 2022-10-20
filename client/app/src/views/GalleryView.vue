<template>
    <section class="overflow-hidden text-gray-700">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" v-if="havePosts">
            <h1 class="text-white py-5">Most likes</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                    <a href="#" class="p-1 md:p-2 w-1/2 button-container" v-if="have1Post">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[0].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostLiked[0].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="p-1 md:p-2 w-1/2 button-container" v-if="have2Posts">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[1].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostLiked[1].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="w-full p-1 md:p-2 button-container" v-if="have3Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[2].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostLiked[2].favorite_count}}</span>
                        </button>
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                    <a href="#" class="w-full p-1 md:p-2 button-container" v-if="have4Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[3].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostLiked[3].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2 button-container" v-if="have5Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[4].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostLiked[4].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2 button-container" v-if="have6Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[5].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostLiked[5].favorite_count}}</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="overflow-hidden text-gray-700">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" v-if="havePosts">
            <h1 class="text-white py-5">Most View</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2" v-if="mostViews">
                    <a href="#" class="p-1 md:p-2 w-1/2 button-container" v-if="have1Post">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[0].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostViewed[0].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="p-1 md:p-2 w-1/2 button-container" v-if="have2Posts">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[1].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostViewed[1].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="w-full p-1 md:p-2 button-container" v-if="have3Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[2].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostViewed[2].favorite_count}}</span>
                        </button>
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2" v-if="mostViews">
                    <a href="#" class="w-full p-1 md:p-2 button-container" v-if="have4Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[3].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostViewed[3].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2 button-container" v-if="have5Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[4].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostViewed[4].favorite_count}}</span>
                        </button>
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2 button-container" v-if="have6Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[5].image.path.toString()">
                        <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                                 stroke="currentColor">
                                <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                            </svg>
                            <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ posts_mostViewed[5].favorite_count}}</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <gallery-card-view :posts="posts"></gallery-card-view>
<!--        <div class="mt-3">-->
<!--            <b-pagination-->
<!--                v-model="paginate.current_page"-->
<!--                :total-rows="paginate.last_page"-->
<!--                :per-page="paginate.per_page"-->
<!--                first-number-->
<!--                last-number-->
<!--            ></b-pagination>-->
<!--        </div>-->
    </section>
<!--    <p>-->
<!--        {{ paginate.current_page }}-->
<!--    </p>-->

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
            paginate: Object,
            // first-number: 1,
            // rows: 0,
            // perpage: 15,
        }
    },
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
            if (this.posts_mostViewed.length > 0) {
                return true
            } else {
                return false
            }
        },
        have1Post() {
            if (this.posts_mostViewed.length >= 1) {
                return true
            } else {
                return false
            }
        },
        have2Posts() {
            if (this.posts_mostViewed.length >= 2) {
                return true
            } else {
                return false
            }
        },
        have3Posts() {
            if (this.posts_mostViewed.length >= 3) {
                return true
            } else {
                return false
            }
        },
        have4Posts() {
            if (this.posts_mostViewed.length >= 4) {
                return true
            } else {
                return false
            }
        },
        have5Posts() {
            if (this.posts_mostViewed.length >= 5) {
                return true
            } else {
                return false
            }
        },
        have6Posts() {
            if (this.posts_mostViewed.length >= 6) {
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
            this.paginate = response.data.meta

        } catch (error) {
            console.log(error)
            this.error = error.message
        }
    }

}
</script>

<style>
body {
    background-color: #000000;
}
/*css bluwbyu*/

/*.button-on-pic{*/
/*    position: absolute;*/
/*    right: 1rem;*/
/*    padding-left: 1.25rem;*/
/*    padding-right: 1.25rem;*/
/*    display: inline-flex;*/
/*    align-items: center;*/
/*    padding-bottom: 6rem;*/
/*    --tw-bg-opacity: 1;*/
/*    background-color: rgb(255 255 255 / var(--tw-bg-opacity));*/
/*    width: 1.25rem;*/
/*    padding-top: 0.25rem;*/
/*    padding-bottom: 0.25rem;*/
/*}*/

:root {
    /* violet */
    /*--primary-color: 111, 76, 255;*/
    --greenlogo: 1, 229, 155;
}

.btn-glow:hover {
    box-shadow: rgba(var(--greenlogo), 0.5) 0px 0px 20px 0px;
}

.button-container{
    /*display:inline-block;*/
    display: inline-flex;
    position:relative;
}

.button-container button{
    display: inline-flex;
    position: absolute;
    /*bottom:4em;*/
    /*right:4em;*/
    background-color:white;
    border-radius:1.5em;
    color:white;
    text-transform:uppercase;
    /*padding:1em 1.5em;*/

    right: 1rem;
    padding-left: 1.25rem;
    padding-right: 1.25rem;
    align-items: center;
    /*padding-bottom: 6rem;*/
    /*width: 1.25rem;*/
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}
</style>
