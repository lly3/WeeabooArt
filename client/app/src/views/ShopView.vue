<template>
    <div v-if=loading>
        <IsLoading />
    </div>
    <div v-else class="min-h-screen text-gary-700">
        <h1 class="text-2xl font-extrabold dark:text-white bg-gray-50 dark:bg-gray-800 py-4 px-8">Shop</h1>
        <section v-if=havePosts class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" >
            <gallery-card-view :posts="posts"></gallery-card-view>
        </section>
        <section class="center" v-if="havePosts">
            <pagination :total-pages="totalPages"
                :total="total"
                :per-page="perPage"
                :current-page="currentPage"
                :has-more-pages="hasMorePages" @pagechanged="pageChanged">
            </pagination>
        </section>
    </div>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import pagination from '../components/Pagination.vue';
import IsLoading from '@/components/IsLoading.vue'
import { postAPI } from '@/services/api.js'


export default {
    components: {
        GalleryCardView,
        pagination,
        IsLoading
    },
    created() {
        this.$watch(
            () => this.$route.query,
            async (toQuery, previousQuery) => {
                const page = parseInt(toQuery.page)
                this.currentPage = page
                const response = await postAPI.paginate(page, 'premium_download');
                this.posts = response.data.data
            }
        )
    },
    data () {
        return {
            posts: [],
            posts_mostLiked: [],
            posts_mostViewed: [],
            error: null,
            loading: true,
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
            this.$router.push(`/shop?page=${pageNumber}`)
            // this.page = pageNumber;
            // console.log("This is event at " + pageNumber);
            // this.getData(pageNumber);
        },
        async getData(pageNumber) {
            // axios.get('/post?page=' + pageNumber)
            await postAPI.paginate(pageNumber)
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
        havePosts() {
            return this.posts.length > 0;
        }
    },
    async mounted() {
        try {
            this.error = null
            const response = await postAPI.fetch()
            this.loading = false
            this.posts = response.data.data
            const page = this.$route.query.page ? parseInt(this.$route.query.page) : 1
            this.currentPage = page
            if (this.posts !== null) {
                const response_page1 = await postAPI.paginate(page, 'premium_download');
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
    cursor: pointer;
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
    overflow: hidden;
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
    transform : translateY(0);
}
</style>
