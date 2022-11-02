<template >
    <div v-if=loading>
        <IsLoading />
    </div>
    <div v-else class="min-h-screen text-gary-700">
        <h1 class="text-2xl font-extrabold dark:text-white bg-gray-50 dark:bg-gray-800 py-4 px-8">Tags</h1>
        <section class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" >
            <section class="overflow-hidden text-gray-700">
                <div class="container mx-auto grid lg:grid-cols-5 sm:grid-cols-2 gap-4">
                    <TagCard v-for="tag in tags" :tag=tag :key=tag.id />
                </div>
            </section>
        </section>
    </div>
</template>

<script>
import TagCard from '@/components/TagCard.vue'

export default {
    data() {
        return {
            tags: null,
            name: null,
            error: null
        }
    },
    components: {
        TagCard
    },
    // },
    methods: {
    },
    async mounted() {
        try {
            this.error = null
            const response = await this.$axios.get('/tags');
            console.log(response)
            this.tags = response.data.data
        } catch(error) {
            console.log(error)
            this.error = error.message
        }

        //
    }
}

</script>

<style scoped>

</style>
