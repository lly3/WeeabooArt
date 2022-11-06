<template>
    <div v-if=loading>
        <IsLoading />
    </div>
    <div v-else class="min-h-screen text-gary-700">
        <h1 class="text-2xl font-extrabold dark:text-white bg-gray-50 dark:bg-gray-800 py-4 px-8">Search: {{ searching }}</h1>
        <div class="input-group flex items-center px-3 lg:px-10 md:px-5 py-4 flex items-center justify-end">
            <form @submit.prevent="onFormSubmit" class="flex items-center w-full md:w-1/2 lg:w-1/3">
                <div class="w-full">
                    <input type="text" v-model="searchKey" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white dark:bg-gray-700 bg-clip-padding border border-solid border-gray-300 dark:border-gray-600 dark:text-white rounded-l-3xl transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-white focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                </div>
                <div class="input-group-prepend">
                    <button :disabled="emptySearch"  @click="search()"  class="cursor-pointer py-2 px-3 text-sm font-medium text-black bg-gray-50 dark:bg-gray-700 rounded-r-3xl border-r border-y border-gray-300 dark:border-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
        </div>
        <section class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" >
            <gallery-card-view :posts="post_searches"></gallery-card-view>
        </section>
    </div>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import SearchBar from "../components/SearchBar.vue";
import IsLoading from '@/components/IsLoading.vue'

export default {
    components: {
        GalleryCardView,
        SearchBar,
        IsLoading
    },
    data () {
        return {
            error: null,
            searchKey: this.searching,
            post_searches: [],
            loading: true
        }
    },
    props: {
        post: Object,
    },
    methods: {
        async search() {
            await this.$axios.get('/post/search?search=' + this.searchKey)
                .then(response => {
                    console.log('searchKey: ' + this.searchKey);
                    this.post_searches = response.data.data;
                    console.log(this.post_searches);
                    this.onFormSubmit();
                });
        },
        onFormSubmit() {
            console.log("onFormSubmit");
            // this.$router.push(`/post/search`);
            this.$router.push({
                name: 'search',
                query: { searchKey: this.searchKey }
            });
            console.log("onFormSubmit success");
        }
    },
    computed: {
        post_search(){
            return this.post_searches.length > 0
        },
        searching(){
            return this.$route.query.searchKey
        },
    },
    async mounted() {
        try {
            this.error = null
            const response = await this.$axios.get('/post/search?search=' + this.searching)
            this.post_searches = response.data.data
            this.loading = false
        } catch (error) {
            console.log(error)
            this.error = error.message
        }
    }
}

</script>

<style scoped>
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
