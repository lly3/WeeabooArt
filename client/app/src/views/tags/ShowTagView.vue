<template>
    <div v-if=loading>
        <IsLoading />
    </div>
    <div v-else class="min-h-screen text-gary-700">
        <h1 class="text-2xl font-extrabold dark:text-white bg-gray-50 dark:bg-gray-800 py-4 px-8 break-all">Tag: {{ this.$route.params.tag }}</h1>
        <section class="container px-5 py-2 mx-auto lg:py-8 lg:px-12" >
            <gallery-card-view :posts="posts"></gallery-card-view>
        </section>
        <section class="center">
            <pagination :total-pages="totalPages"
                :total="total"
                :per-page="perPage"
                :current-page="currentPage"
                :has-more-pages=hasMorePages @pagechanged="pageChanged">
            </pagination>
        </section>
    </div>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
import Pagination from "@/components/Pagination.vue"
import { tagAPI } from "@/services/api.js"

export default {
    created() {
        this.$watch(
            () => this.$route.query,
            async (toQuery, previousQuery) => {
                const page = parseInt(toQuery.page)
                const tag = this.$route.params.tag
                this.currentPage = page
                const response = await tagAPI.paginate(tag, page);
                this.posts = response.data.data
            }
        )
    },
    data() {
        return {
            posts:null,
            title: null,
            error: null,
            perPage: 15,
            total: 1,
            totalPages: 1,
            currentPage: 1,
            hasMorePages: true,
            page: 1,
        }
    },
    props: {
    },
    components: {
        GalleryCardView,
        Pagination
    },
    async mounted() {
        try {
            const tag = this.$route.params.tag
            const page = this.$route.query.page ? parseInt(this.$route.query.page) : 1
            const response = await tagAPI.paginate(tag, page)
            this.posts = response.data.data
            this.currentPage = page
            this.totalPages = response.data.meta.last_page
            console.log(response.data.meta);
        } catch(error) {
            console.log(error)
            this.error = error.message
        }
    },
    methods: {
        pageChanged(pageNumber) {
            this.$router.push(`/tags/${this.$route.params.tag}?page=${pageNumber}`)
        },
    }
}

</script>
