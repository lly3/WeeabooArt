<template>
    <div class="bg-gray-800 text-white p-6 ">
        <div class="flex flex-row">
            <h1 class="basis-1/3">HOME</h1>
            <div class="basis-1/3 flex flex-row">
                <button class="basis-1/2 grid justify-items-end mx-4">Gallery</button>
                <button class="basis-1/2 grid justify-items-start mx-4 text-gray-400 hover:text-white">Posts</button>
            </div>
        </div>
    </div>

    <section class="overflow-hidden text-gray-700 bg-black">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12">
            <h1 class="text-white py-5">Most likes</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2">
                    <a href="#" class="p-1 md:p-2 w-1/2">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             src="http://localhost/images/202210100035WIN_20220720_14_18_33_Pro.jpg">
                    </a>
                    <a href="#" class="p-1 md:p-2 w-1/2">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             src="http://localhost/images/202210100035WIN_20220720_14_18_33_Pro.jpg">
                    </a>
                    <a href="#" class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="http://localhost/images/202210102056ezgif-3-db29008d15.gif">
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2">
                    <a href="#" class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp">
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp">
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="overflow-hidden text-gray-700 bg-black">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12">
            <h1 class="text-white py-5">Recent</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2">
                    <a href="#" class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="http://localhost/images/202210102056ezgif-3-db29008d15.gif">
                    </a>
                    <a href="#" class="p-1 md:p-2 w-1/2">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             src="http://localhost/images/202210100035WIN_20220720_14_18_33_Pro.jpg">
                    </a>
                    <a href="#" class="p-1 md:p-2 w-1/2">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             src="http://localhost/images/202210100035WIN_20220720_14_18_33_Pro.jpg">
                    </a>
                </div>
                <div class="flex flex-wrap w-1/2">
                    <a href="#" class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp">
                    </a>
                    <a href="#" class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp">
                    </a>
                    <a href="#" class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="overflow-hidden text-gray-700 bg-black">
        <div class="container px-5 py-2 mx-auto lg:py-8 lg:px-12">
            <div class="flex flex-wrap -m-1 md:-m-2">
                <gallery-card-view :posts="posts"></gallery-card-view>
            </div>
        </div>
    </section>
</template>

<script>
import GalleryCardView from "@/components/GalleryCardView.vue";
export default {
    data () {
        return {
            posts: Object,
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
        try {
            this.error = null
            const response = await this.$axios.get('/post');
            this.posts = response.data.data
            console.log(this.posts)
        } catch (error) {
            console.log(error)
            this.error = error.message
        }
    }
}
</script>
