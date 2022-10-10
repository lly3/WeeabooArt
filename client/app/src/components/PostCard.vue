<template>
    <a :href=concatFunction class="w-1/2 p-1 md:p-2">
        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
             :src=concatFunction>
    </a>
<!--    <h1>http://localhost/images/{{ post.image.path }}</h1>-->
<!--    {{ post }}-->
</template>

<script>
export default {
    computed: {
        concatFunction: function ()  {
            return 'http://localhost/images/' + this.post.image.path
        }
    },
    props: {
        post: Object
    }
}
</script>
