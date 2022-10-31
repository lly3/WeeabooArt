<template>
    <div class="bg-gray-800 text-white p-6 ">
        <div class="flex flex-row">
            <h1 class="basis-1/3">HOME</h1>
            <div class="basis-1/3 flex flex-row">
                <button class="basis-1/2 grid justify-items-end mx-4">Gallery</button>
                <button class="basis-1/2 grid justify-items-start mx-4 text-gray-400 hover:text-white">Posts</button>
            </div>
        </div>
    </div>

    <div class="bg-black">
        <section>
            <collection :posts="posts"></collection>
        </section>
    </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js'
import Collection from "@/components/Collection.vue";
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
        Collection
    },
    async mounted() {
        try {
            this.error = null
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
}
</script>
