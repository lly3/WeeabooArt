<template>
    <section class="overflow-hidden text-gray-700">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" v-if="havePosts">
            <h1 class="text-white py-5">Most likes</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                    <a href="#" class="p-1 md:p-2 w-1/2" v-if="have1Post">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[0].image.path.toString()">
                    </a>
                    <a href="#" class="p-1 md:p-2 w-1/2" v-if="have2Posts">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[1].image.path.toString()">
                    </a>
                    <a href="#" class="w-full p-1 md:p-2" v-if="have3Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[2].image.path.toString()">
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2" v-if="mostLikes">
                    <a href="#" class="w-full p-1 md:p-2" v-if="have4Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[3].image.path.toString()">
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2" v-if="have5Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[4].image.path.toString()">
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2" v-if="have6Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostLiked[5].image.path.toString()">
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
                    <a href="#" class="p-1 md:p-2 w-1/2" v-if="have1Post">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[0].image.path.toString()">
                    </a>
                    <a href="#" class="p-1 md:p-2 w-1/2" v-if="have2Posts">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[1].image.path.toString()">
                    </a>
                    <a href="#" class="w-full p-1 md:p-2" v-if="have3Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[2].image.path.toString()">
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2" v-if="mostViews">
                    <a href="#" class="w-full p-1 md:p-2" v-if="have4Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[3].image.path.toString()">
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2" v-if="have5Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[4].image.path.toString()">
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2" v-if="have6Posts">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             :src="'http://localhost/images/' + posts_mostViewed[5].image.path.toString()">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <gallery-card-view :posts="posts"></gallery-card-view>
    </section>
    <section class="center">
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
        // VueTailwindPagination,
        // VueAdsPagination,
        pagination
    },
    data () {
        return {
            posts: Object,
            posts_mostLiked: [],
            posts_mostViewed: [],
            error: null,
            perPage: 15,
            total: 20,
            totalPages: 20,
            currentPage: 1,
            hasMorePages: true,
            page: 1
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
            this.total = response.data.meta.total
            this.current = 1

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
.center {
    display: flex;
    justify-content: center;
    text-align: center;
    padding: 10px;
}

</style>
