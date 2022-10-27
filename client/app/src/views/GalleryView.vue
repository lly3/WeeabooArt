<template>
    <div class="input-group flex items-center px-3 lg:px-10 md:px-5 pt-4 flex items-center justify-end pr-6">
        <form @submit.prevent="onFormSubmit" class="flex items-center">
            <div class="relative w-full">
                <input type="text" v-model="searchKey" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-white focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
            </div>
            <div class="input-group-prepend">
                <button :disabled="emptySearch"  @click="search()"  class="p-2.5 ml-2 text-sm font-medium text-black bg-white rounded-lg border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </form>
    </div>

    <section class="py-4 lg:py-8">
        <gallery-card-view :posts="posts"></gallery-card-view>
    </section>

    <section class="overflow-hidden text-gray-700">
        <div class="container px-5 pb-2 mx-auto lg:py-8 lg:px-12" v-if="havePosts">
            <h1 class="text-white py-5">Most likes</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[0].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have1Post">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[1].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have2Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[2].id" class="w-full p-1 md:p-2 button-container" v-if="have3Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[3].id" class="w-full p-1 md:p-2 button-container" v-if="have4Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[4].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have5Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[5].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have6Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[0].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have1Post">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[1].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have2Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[2].id" class="w-full p-1 md:p-2 button-container" v-if="have3Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[3].id" class="w-full p-1 md:p-2 button-container" v-if="have4Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[4].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have5Posts">
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
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[5].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have6Posts">
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



    <section class="center" v-if="havePosts">
        <pagination :total-pages="totalPages"
                         :total="total"
                         :per-page="perPage"
                         :current-page="currentPage"
                         :has-more-pages="hasMorePages" @pagechanged="pageChanged">
        </pagination>
    </section>

</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import pagination from '../components/Pagination.vue';


export default {
    components: {
        GalleryCardView,
        pagination
    },
    data () {
        return {
            posts: Object,
            posts_mostLiked: [],
            posts_mostViewed: [],
            error: null,
            perPage: 15,
            total: 1,
            totalPages: 1,
            currentPage: 1,
            hasMorePages: true,
            page: 1,
            searchKey: '',
            disabledSearch: false
        }
    },
    props: {
        post: Object,
    },
    methods: {
        pageChanged(pageNumber) {
            this.currentPage = pageNumber;
            this.page = pageNumber;
            console.log("This is event at " + pageNumber);
            this.getData(pageNumber);
        },
        async getData(pageNumber) {
            // axios.get('/post?page=' + pageNumber)
            await this.$axios.get('/post/?page=' + pageNumber)
                .then(response => {
                    this.page = pageNumber;
                    this.posts = response.data.data;
                    this.total = response.data.meta.total;
                    this.totalPages = response.data.meta.last_page;
                    this.perPage = response.data.meta.per_page;
                    console.log("This is get at " + pageNumber);
                });
        },
        async search() {
            await this.$axios.get('/post/search?search=' + this.searchKey)
                .then(response => {
                    console.log('searchKey: ' + this.searchKey);
                    this.posts = response.data.data;
                    console.log(this.posts);
                    this.onFormSubmit();
                });
        },
        onFormSubmit() {}
    },
    computed: {
        emptySearch(){
            return this.searchKey === ''
        },
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
            if (this.posts !== null) {
                const response_page1 = await this.$axios.get('/post?page=1');
                this.posts = response_page1.data.data
                this.page = 1;
                this.posts = response_page1.data.data;
                this.total = response_page1.data.meta.total;
                this.totalPages = response_page1.data.meta.last_page;
                this.perPage = response_page1.data.meta.per_page;
                console.log("get page 1 success");
            }
            this.total = response.data.meta.total
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
.center {
    display: flex;
    justify-content: center;
    text-align: center;
    padding: 10px;
}
</style>
