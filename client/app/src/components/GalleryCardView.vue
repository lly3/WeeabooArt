<template>
<!--    {{ posts}}-->
    <section v-if="size == 'small'" class="overflow-hidden text-gray-700">
        <div class="mx-auto grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 md:gap-2 gap-4">
            <post-card v-for="post in posts" :model=model :square="true" :post="{ ...post }" :key="post.id"></post-card>
        </div>
    </section>
    <section v-else class="overflow-hidden text-gray-700">
        <div class="container mx-auto grid lg:grid-cols-5 sm:grid-cols-2 gap-4">
            <post-card v-for="post in posts" :post="{ ...post }" :key="post.id"></post-card>
        </div>
    </section>
</template>

<script>
import PostCard from '@/components/PostCard.vue'
export default {
    components: {
        PostCard
    },
    props: {
        posts: Array,
        size: {
            default: 'large',
            type: String
        },
        model: {
            default: 'post',
            type: String
        }
    }
}
</script>

<style>
</style>
