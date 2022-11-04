<template>
    <div>
        <!-- Search bar component -->
        <section>
            <SearchBar></SearchBar>
        </section>

        <!-- Result of search -->
        <section class="py-4 lg:py-8">
            <h1 class="dark:text-white container px-5 mx-auto lg:px-12" v-if="post_search">You are searching: " {{this.$route.params.searchKey}} "</h1>
            <h1 class="dark:text-white container px-5 mx-auto lg:px-12" v-if="no_post_search">No post title: " {{this.$route.params.searchKey}} "</h1>
            <gallery-card-view :posts="post_searches"></gallery-card-view>
        </section>

    </div>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import SearchBar from "../components/SearchBar.vue";

export default {
    components: {
        GalleryCardView,
        SearchBar
    },
    data () {
        return {
            error: null,
            searchKey: this.searching,
            post_searches: [],
        }
    },
    props: {
        post: Object,
    },
    computed: {
        post_search(){
            return this.post_searches.length > 0
        },
        no_post_search(){
            return this.post_searches.length == 0
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
