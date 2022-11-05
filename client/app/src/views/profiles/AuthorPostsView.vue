<template>
    <div >
        <div class="bg-black">
            <section class="py-4 lg:py-8 dark:dark-body">
                <profile-header :author="author"></profile-header>
            </section>
            
            <h1 class="font-bold underline cursor-pointer text-white">Posts</h1>
            <section class="py-4 lg:py-8 dark:dark-body">
                <gallery-card-view :posts="posts"></gallery-card-view>
            </section>
        </div>
    </div>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import ProfileHeader from "@/components/ProfileHeader.vue";
export default {
    data() {
        return {
            posts: Object,
            author: Object,
            error: null
        }
    },
    components: {
        ProfileHeader,
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
            const userResposne = await this.$axios.get('/profile/' + this.getParamsId)
            this.author = userResposne.data.data
            console.log(this.author)
        } catch (error) {
            console.log(error)
            this.error = error.message
        }

        try {
            this.error = null
            const response = await this.$axios.get('/profile/' + this.getParamsId + '/posts')
            this.posts = response.data.data
            console.log(this.posts)
        } catch (error) {
            console.log(error)
            this.error = error.message
        }
    },

}
</script>