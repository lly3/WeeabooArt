<template>
    <!--    <div v-for="post in posts" :key="post.id"-->
    <!--         :post="{...post}"  >-->
    <!--            {{post.title}}-->
    <!--    </div>-->
    <section>
        <gallery-card-view :posts="posts"></gallery-card-view>
    </section>

</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
export default {
    data() {
        return {
            posts:null,
            title: null,
            error: null
        }
    },
    props: {
        post: Object
    },
    components: {
        GalleryCardView
    },
    async mounted() {
        const id = this.$route.params.id
        console.table(id)
        const url = `/tags/${id}`
        try {
            this.error = null
            const response = await this.$axios.get(url);
            console.table(response)
            this.posts = response.data.data
        } catch(error) {
            console.log(error)
            this.error = error.message
        }

        //
    }
}

</script>
