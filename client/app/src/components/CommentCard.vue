<template>
    <div class="antialiased  max-w-screen-l">
        <div class="space-y-4">
            <div class="flex">
                <div class="flex-shrink-0 mr-3">
                    <img class="sm:h-[50px] sm:w-[55px] h-[30px] w-[35px] rounded-lg object-cover" :src=imageURL(comment.user_image) alt="">
                </div>
                <div class="flex-1 bg-gray-100 dark:bg-gray-800 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                    <strong class="dark:text-white">{{ comment.user_name }}</strong> <span class="text-xs text-gray-400 ">{{comment.published}}</span>
                    <p class="text-sm break-all dark:text-white ">
                        {{comment.message}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    props:{
        comment: Object
    },
    methods:{
        imageURL(path) {
            return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
        },
    }
}
</script>
