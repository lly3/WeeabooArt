<template>
    <section class="overflow-hidden text-gray-700">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12 grid lg:grid-cols-5 sm:grid-cols-2 gap-4">
            <collection-post-card v-for="post in posts" :post="{ ...post }" :key="post.id"></collection-post-card>
        </div>
    </section>
</template>

<script>
import CollectionPostCard from '@/components/CollectionPostCard.vue'
export default {
    data() {
        return {
            posts: ''
        }
    },
    components: {
        CollectionPostCard
    },
    props: {
        posts: Array
    }
}
</script>
