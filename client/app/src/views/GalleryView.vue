<template>
    <!-- Search bar -->
    <div class="input-group flex items-center px-3 lg:px-10 md:px-5 pt-4 flex items-center justify-end pr-6 dark:dark-body">
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

    <!-- Most Viewed & Most Liked -->
    <section class="overflow-hidden text-gray-700 dark:dark-body">
        <div class="container px-5 pb-2 mx-auto lg:py-8 lg:px-12" v-if="havePosts">
            <h1 class="dark:text-white pb-5">Most likes</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[0].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have1Post">
                        <figure class="snip">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[0].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostLiked[0].title }}</h3>
                                <h5>By {{ posts_mostLiked[0].user_name}}</h5>
                                <h3>{{ posts_mostLiked[0].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[1].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have2Posts">
                        <figure class="snip">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[1].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostLiked[1].title }}</h3>
                                <h5>By {{ posts_mostLiked[1].user_name}}</h5>
                                <h3>{{ posts_mostLiked[1].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[2].id" class="w-full p-1 md:p-2 button-container" v-if="have3Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[2].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostLiked[2].title }}</h3>
                                <h5>By {{ posts_mostLiked[2].user_name}}</h5>
                                <h3>{{ posts_mostLiked[2].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[3].id" class="w-full p-1 md:p-2 button-container" v-if="have4Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[3].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostLiked[3].title }}</h3>
                                <h5>By {{ posts_mostLiked[3].user_name}}</h5>
                                <h3>{{ posts_mostLiked[3].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[4].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have5Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[4].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostLiked[4].title }}</h3>
                                <h5>By {{ posts_mostLiked[4].user_name}}</h5>
                                <h3>{{ posts_mostLiked[4].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostLiked[5].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have6Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostLiked[5].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostLiked[5].title }}</h3>
                                <h5>By {{ posts_mostLiked[5].user_name}}</h5>
                                <h3>{{ posts_mostLiked[5].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="overflow-hidden text-gray-700 dark:dark-body">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" v-if="havePosts">
            <h1 class="dark:text-white pb-5">Most View</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2" v-if="mostViews">
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[0].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have1Post">
                        <figure class="snip">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[0].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostViewed[0].title }}</h3>
                                <h5>By {{ posts_mostViewed[0].user_name}}</h5>
                                <h3>{{ posts_mostViewed[0].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[1].id" class="p-1 md:p-2 w-1/2 button-container" v-if="have2Posts">
                        <figure class="snip">
                            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[1].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostViewed[1].title }}</h3>
                                <h5>By {{ posts_mostViewed[1].user_name}}</h5>
                                <h3>{{ posts_mostViewed[1].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[2].id" class="w-full p-1 md:p-2 button-container" v-if="have3Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[2].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostViewed[2].title }}</h3>
                                <h5>By {{ posts_mostViewed[2].user_name}}</h5>
                                <h3>{{ posts_mostViewed[2].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2" v-if="mostViews">
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[3].id" class="w-full p-1 md:p-2 button-container" v-if="have4Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[3].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostViewed[3].title }}</h3>
                                <h5>By {{ posts_mostViewed[3].user_name}}</h5>
                                <h3>{{ posts_mostViewed[3].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[4].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have5Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[4].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostViewed[4].title }}</h3>
                                <h5>By {{ posts_mostViewed[4].user_name}}</h5>
                                <h3>{{ posts_mostViewed[4].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                    <a :href="'http://localhost:3000/post/' + posts_mostViewed[5].id" class="w-1/2 p-1 md:p-2 button-container" v-if="have6Posts">
                        <figure class="snip">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                 :src="'http://localhost/images/' + posts_mostViewed[5].image.path.toString()">
                            <figcaption>
                                <h3>{{ posts_mostViewed[5].title }}</h3>
                                <h5>By {{ posts_mostViewed[5].user_name}}</h5>
                                <h3>{{ posts_mostViewed[5].favorite_count }} Like</h3>
                            </figcaption>
                        </figure>
                        <a href=""></a>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Posts -->
    <section class="py-4 lg:py-8 dark:dark-body">
        <h1 class="dark:text-white container px-5 mx-auto lg:px-12" v-if="havePosts">Post</h1>
        <gallery-card-view :posts="posts"></gallery-card-view>
    </section>

    <!-- Pagination -->
    <section class="center dark:dark-body" v-if="havePosts">
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
            disabledSearch: false,
            post_searches: []
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
        search() {
            console.log('searchKey: ' + this.searchKey);
            this.onFormSubmit();
            console.log("$router.push success");

        },
        onFormSubmit() {
            console.log("onFormSubmit");
            // this.$router.push(`/post/search`);
            this.$router.push({
                name: 'post.search',
                params: {searchKey: this.searchKey}
            });
            console.log("onFormSubmit success");
        }
    },
    computed: {
        emptySearch(){
            return this.searchKey === ''
        },
        post_search(){
            return this.post_searches.length
        },
        mostLikes() {
            return this.posts_mostLiked.length
        },
        mostViews() {
            return this.posts_mostViewed.length
        },
        havePosts() {
            return this.posts_mostViewed.length > 0;
        },
        have1Post() {
            return this.posts_mostViewed.length >= 1;
        },
        have2Posts() {
            return this.posts_mostViewed.length >= 2;
        },
        have3Posts() {
            return this.posts_mostViewed.length >= 3;
        },
        have4Posts() {
            return this.posts_mostViewed.length >= 4;
        },
        have5Posts() {
            return this.posts_mostViewed.length >= 5;
        },
        have6Posts() {
            return this.posts_mostViewed.length >= 6;
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

.snip {
    position: relative;
    display: inline-block;
    overflow-wrap: anywhere;
    margin: 10px 8px;
    width: 100%;
    color: #ffffff;
    text-align: center;
}

.snip * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.snip:before {
    position: absolute;
    top: 10px;
    left: 10px;
    right: 10px;
    bottom: 10px;
    top: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    content: '';
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    -webkit-transition-delay: 0.3s;
    transition-delay: 0.3s;
}

.snip img {
    max-width: 100%;
    backface-visibility: hidden;
    vertical-align: top;
}

.snip figcaption {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.snip h3,
.snip h5 {
    margin: 0;
    opacity: 0;
    letter-spacing: 1px;
}

.snip h3 {
    -webkit-transform : translateY(-100%);
    transform : translateY(-100%);
    text-transform: uppercase;
    font-weight: 400;
    -webkit-transition-delay: 0.05s;
    transition-delay: 0.05s;
    margin-bottom: 5px;
}

.snip h5 {
    font-weight: 400;
    background-color: #A0A0A0;
    margin: 0px 10px;
    padding: 3px 10px;
    -webkit-transform : translateY(100%);
    transform : translateY(100%);
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
}

.snip a {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.snip:hover:before,
.snip.hover:before {
    top: 10px;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
}

.snip:hover h3,
.snip.hover h3,
.snip:hover h5,
.snip.hover h5 {
    opacity: 1;
    -webkit-transform : translateY(0);
    padding: 0px 10px;
}
</style>
