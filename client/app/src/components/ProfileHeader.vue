<template>
    <div class="flex items-center">
        <img alt="No Image" class="rounded-lg normal_image"
                     :src=imageURL>
        <div class="flex flex-col ml-3 w-full">
            <h1 class="text-white text-lg">{{ author.name }}</h1>
        </div>
    </div>   
</template>

<script>
export default {
    computed: {
        imageURL: function ()  {
            return 'http://localhost/images/' + this.author.image
        }
    },
    props: {
        author: Object
    }
}
</script>