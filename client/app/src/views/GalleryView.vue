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
        <div class="container px-5 py-2 mx-auto lg:py-6 lg:px-8">
            <h1 class="text-white py-5">Most likes</h1>
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/2">
                    <div class="p-1 md:p-2 w-1/2">
                        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://dummyimage.com/600x400">
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="/public/images/202210061541wallpaperbetter.jpg">
                    </div>
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp">
                    </div>
                </div>
                <div class="flex flex-wrap w-1/2">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp">
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp">
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                             src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp">
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import ImageCard from "@/components/ImageCard";

export default {
    // data() {
    //     return {
    //
    //     }
    // }
    // components: {
    //     ImageCard
    // },
}

</script>
