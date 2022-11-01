<template>

    <!-- Search bar component -->
    <section>
        <SearchBar></SearchBar>
    </section>

    <!-- Posts -->
    <section class="py-4 lg:py-8 dark:dark-body">
        <h1 class="dark:text-white container px-5 mx-auto lg:px-12" v-if="haveCollection">My Collection</h1>
        <h1 class="dark:text-white container px-5 mx-auto lg:px-12 text-center mt-4" v-if="!haveCollection">You don't have collection.</h1>
        <gallery-card-view :posts="posts"></gallery-card-view>
    </section>

</template>

<script>
import { useAuthStore } from '@/stores/auth.js'
import GalleryCardView from "@/components/GalleryCardView.vue";
import SearchBar from '../components/SearchBar.vue';
export default {
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },
    data () {
        return {
            posts: Object,
            error: null,
        }
    },
    props: {
        post: Object
    },
    components: {
        GalleryCardView,
        SearchBar
    },
    async mounted() {
        this.error = null
        if(!this.auth_store.isAuthen)
            return this.$router.push('/login')
        else {
            try {
                const response = await this.$axios.get(`/my-collection`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("jwt_token")}`
                    }
                });
                this.posts = response.data.data
                console.log(this.posts)
            } catch (error) {
                console.log(error)
                this.error = error.message
            }
        }

    },
    computed: {
        haveCollection() {
            return this.posts.length > 0
        }
    }
}
</script>
