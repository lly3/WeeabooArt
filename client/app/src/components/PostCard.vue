<template>
    <div class="aspect-square">
            <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                 :src=concatFunctionImage>
    </div>

<!--    <h1>http://localhost/images/{{ post.image.path }}</h1>-->
<!--    {{ post }}-->
</template>

<script>
export default {
    computed: {
        concatFunctionImage: function ()  {
            return 'http://localhost/images/' + this.post.image
        },
        concatFunction: function ()  {
            return 'http://localhost:3000/post/' + this.post.id
        }
    },
    props: {
        post: Object
    }
}
</script>

<style scoped>
/*css bluwbyu*/

/*.button-on-pic{*/
/*    position: absolute;*/
/*    right: 1rem;*/
/*    padding-left: 1.25rem;*/
/*    padding-right: 1.25rem;*/
/*    display: inline-flex;*/
/*    align-items: center;*/
/*    padding-bottom: 6rem;*/
/*    --tw-bg-opacity: 1;*/
/*    background-color: rgb(255 255 255 / var(--tw-bg-opacity));*/
/*    width: 1.25rem;*/
/*    padding-top: 0.25rem;*/
/*    padding-bottom: 0.25rem;*/
/*}*/

:root {
    /* violet */
    /*--primary-color: 111, 76, 255;*/
    --greenlogo: 1, 229, 155;
}

.btn-glow:hover {
    box-shadow: rgba(var(--greenlogo), 0.5) 0px 0px 20px 0px;
}

.button-container{
    /*display:inline-block;*/
    display: inline-flex;
    position:relative;
}

.button-container button{
    display: inline-flex;
    position: absolute;
    /*bottom:4em;*/
    /*right:4em;*/
    background-color:white;
    border-radius:1.5em;
    color:white;
    text-transform:uppercase;
    /*padding:1em 1.5em;*/

    right: 1rem;
    padding-left: 1.25rem;
    padding-right: 1.25rem;
    align-items: center;
    /*padding-bottom: 6rem;*/
    /*width: 1.25rem;*/
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}
</style>
