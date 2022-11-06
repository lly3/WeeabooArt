<template>
    <section class="overflow-hidden text-gray-700">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12 grid lg:grid-cols-5 sm:grid-cols-2 gap-4">
            <favorite-post-card v-for="post in posts" :post="{ ...post }" :key="post.id"></favorite-post-card>
        </div>
    </section>
</template>

<script>
import FavoritePostCard from '@/components/FavoritePostCard.vue'
export default {
    data() {
        return {
            posts: ''
        }
    },
    components: {
        FavoritePostCard
    },
    props: {
        posts: Array
    }
}
</script>
