<template>
    <div >
        <div class="dark:bg-gray-800">
            <section class="py-4 lg:py-8">
                <profile-header :author="author"></profile-header>
            </section>
            
            <h1 class="mx-8 font-bold dark:text-white text-2xl">Posts</h1>
            <section class="py-4 lg:py-8 dark:dark-body">
                <gallery-card-view :posts="posts"></gallery-card-view>
            </section>

            <h1 class="mx-8 font-bold dark:text-white text-2xl">Commissions</h1>
            <section class="py-4 lg:py-8 dark:dark-body">
                <all-commission-card :commissions="commissions"></all-commission-card>
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
