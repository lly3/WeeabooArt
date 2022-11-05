<template>
    <div class="bg-black">
        <h1 class="text-white">Posts</h1>
        <section class="py-4 lg:py-8 dark:dark-body">
            <gallery-card-view :posts="posts"></gallery-card-view>
        </section>
    </div>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
export default {
    data() {
        return {
            posts: Object,
            error: null
        }
    },
    components: {
        GalleryCardView
    },
    computed: {
        getParamsId() {
            return this.$route.params.id
        }
    },
    async mounted() {
        try {
            this.error = null
            const response = await this.$axios.get('/profile/' + this.getParamsId + '/posts')
            this.posts = response.data.data
            console.log(this.posts)
        } catch (error) {
            console.log(error)
            this.error = error.message
        }
    }
}
</script>