<template>
        <div v-for="comment in comments">
    <div class="antialiased  max-w-screen-l py-3">
        <div class="space-y-4">
            <div class="flex">
                <div class="flex-shrink-0 mr-3">
                    <img class="sm:h-[50px] sm:w-[55px] h-[30px] w-[35px] rounded-lg object-cover" :src=imageURL(comment.user_image) alt="">
                </div>
                <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                    <strong>{{ comment.user_name}}</strong> <span class="text-xs text-gray-400">{{comment.published}}</span>
                    <p class="text-sm break-all">
                        {{comment.message}}
                    </p>
                </div>
            </div>
        </div>
    </div>
        </div>
</template>

<script>


export default {

    props:{
        comments: Object
    },
    methods:{
        imageURL(path) {
            return 'http://localhost/images/' + path
        },
    }
}
</script>
