<template>
<!--    {{ posts}}-->
    <div class="flex flex-wrap bg-black">
        <post-card v-for="post in posts" :post="{ ...post }" :key="post.id" class="p-1 md:p-2 w-1/5"></post-card>
    </div>
</template>

<script>
import PostCard from '@/components/PostCard.vue'
export default {
    data() {
        return {
            posts: ''
        }
    },
    components: {
        PostCard
    },
    props: {
        posts: Array
    }
}
</script>
