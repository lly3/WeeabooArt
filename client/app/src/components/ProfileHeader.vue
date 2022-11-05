<template>
    <div class="flex items-center">
        <img class="w-[60px] h-[60px] rounded-xl object-cover"
                     :src=imageURL>
        <div class="font-bold underline cursor-pointer hover:text-greenlogo text-white">
            <h1 class="text-lg"> {{ this.author.name }}</h1>
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