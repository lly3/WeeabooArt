<template>
    <div class="min-h-screen">
        <div class="dark:bg-gray-800">
            <section class="" >
                <profile-header :author="author"></profile-header>
            </section>
            
            <section class="container px-5 py-2 mx-auto lg:px-12" >
                <h1 class="dark:text-white py-5 text-xl font-light">Posts</h1>
                <gallery-card-view :posts="posts"></gallery-card-view>
            </section>

            <section class="container pb-5 py-2 mx-auto lg:px-12" >
                <h1 class="dark:text-white py-5 text-xl font-light">Commissions</h1>
                <gallery-card-view :posts="commissions" model=commission ></gallery-card-view>
            </section>

        </div>
    </div>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import ProfileHeader from "@/components/ProfileHeader.vue";
import AllCommissionCard from "@/components/AllCommissionCard.vue";
export default {
    data() {
        return {
            author: Object,
            posts: Object,
            commissions: Object,
            error: null
        }
    },
    components: {
        ProfileHeader,
        GalleryCardView,
        AllCommissionCard
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
            const postResponse = await this.$axios.get('/profile/' + this.getParamsId + '/posts')
            this.posts = postResponse.data.data
            console.log(this.posts)
        } catch (error) {
            console.log(error)
            this.error = error.message
        }

        try {
            this.error = null
            const commissionResponse = await this.$axios.get('/profile/' + this.getParamsId + '/commissions')
            this.commissions = commissionResponse.data.data
            console.log(this.commissions)
        } catch (error) {
            console.log(error)
            this.error = error.message
        }
    },

}
</script>
