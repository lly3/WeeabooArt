<template>
    <div v-if=loading>
        <IsLoading />
    </div>
    <div v-else class="min-h-screen text-gary-700">
        <h1 class="text-2xl font-extrabold dark:text-white bg-gray-50 dark:bg-gray-800 py-4 px-8">My Favorite</h1>
        <section class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" >
            <section class="overflow-hidden text-gray-700">
                <div class="container mx-auto grid lg:grid-cols-5 sm:grid-cols-2 gap-4">
                    <section>
                        <favorite :posts="posts"></favorite>
                    </section>
                </div>
            </section>
        </section>
    </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js'
import Favorite from '@/components/Favorite.vue';
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
        Favorite,
        IsLoading
    },
    async mounted() {
        this.error = null
        if(!this.auth_store.isAuthen)
            return this.$router.push('/login')

        try {
            const response = await this.$axios.get(`/my-favorite`, {
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
        this.loading = false

    }
}
</script>
