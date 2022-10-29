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
        <h1 class="dark:text-white container px-5 mx-auto lg:px-12" v-if="post_search">You are searching: " {{this.$route.params.searchKey}} "</h1>
        <gallery-card-view :posts="post_searches"></gallery-card-view>
    </section>




</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import { useRoute, useRouter } from 'vue-router'
export default {
    components: {
        GalleryCardView,
    },
    data () {
        return {
            error: null,
            searchKey: this.searching,
            disabledSearch: false,
            post_searches: [],

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
        searching(){
            return this.$route.params.searchKey
        },
    },

    async mounted() {
        try {
            this.error = null
            const response = await this.$axios.get('/post/search?search=' + this.searching)
            this.post_searches = response.data.data
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
</style>
