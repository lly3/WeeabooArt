<template>
    <div v-if=loading>
        <IsLoading />
    </div>
    <div v-else class="min-h-screen text-gary-700">
        <h1 class="text-2xl font-extrabold dark:text-white bg-gray-50 dark:bg-gray-800 py-4 px-8">My Collection</h1>
        <section class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" >
            <section class="overflow-hidden text-gray-700">
                <section>
                    <collection :posts="posts"></collection>
                </section>
            </section>
        </section>
    </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js';
import GalleryCardView from "@/components/GalleryCardView.vue";
import SearchBar from '../components/SearchBar.vue';
import Collection from "@/components/Collection.vue";
import IsLoading from '@/components/IsLoading.vue';
export default {
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },
    data () {
        return {
            posts: Object,
            error: null,
            loading: true
        }
    },
    props: {
        post: Object
    },
    components: {
        GalleryCardView,
        SearchBar,
        Collection,
        IsLoading
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
