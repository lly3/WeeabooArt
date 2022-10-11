<template>
    <div class="w-full">
        <a :href=concatFunction>
            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                 :src=concatFunction>
        </a>
    </div>

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

<style scoped>

</style>
