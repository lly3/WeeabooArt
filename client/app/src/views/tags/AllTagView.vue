<template>
    <div class="mx-8">
        <div class="mx-8">
            <h1 class="text-3xl text-yellow-700">Tags</h1>

            <div v-for="tag in tags" :key="tag.id"
                 :tag="{...tag}"  >

                <button @click="selectTag(tag)"
                        class="p-2 bg-blue-200 border-2 border-blue-400 rounded-xl">
                    {{ tag.name }}
                </button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tags: null,
            name: null,
            error: null
        }
    },
    // },
    methods: {
        selectTag(tag) {
            console.table(tag)
            this.$router.push(`tags/${tag.id}`)
        }
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
