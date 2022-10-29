<template>
    <div v-if=square class="aspect-square cursor-pointer" @click="() => this.$router.push(`/${this.model}/${this.post.id}`)">
        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
                            :src=concatFunctionImage>
    </div>
    <div v-else class="w-full justify-center flex cursor-pointer" @click="() => this.$router.push(`/post/${this.post.id}`)">
        <img alt="No Image" class="rounded-lg normal_image"
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
        post: Object,
        square: {
            default: false,
            type: Boolean
        },
        model: {
            default: 'post',
            type: String
        }
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
.normal_image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    object-position: center;
    justify-content: center;
    text-align: center;
}
/*@media screen and (max-width: 480px) {*/
/*    .normal_image {*/
/*        width: 500px;*/
/*        height: 100%;*/
/*        object-fit: cover;*/
/*        object-position: center;*/
/*    }*/
/*}*/
/*@media screen and (max-width: 640px) {*/
/*    .normal_image {*/
/*        width: 700px;*/
/*        height: 100%;*/
/*        object-fit: cover;*/
/*        object-position: center;*/
/*    }*/
/*}*/
@media screen and (max-width: 1000px) {
    .normal_image {
        width: 800px;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
}
.snip {
    position: relative;
    display: inline-block;
    overflow: hidden;
    margin: 10px 8px;
    min-width: 230px;
    max-width: 315px;
    width: 100%;
    color: #ffffff;
    text-align: center;
}

.snip * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.snip:before {
    position: absolute;
    top: 10px;
    left: 10px;
    right: 10px;
    bottom: 10px;
    top: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    content: '';
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    -webkit-transition-delay: 0.3s;
    transition-delay: 0.3s;
}

.snip img {
    max-width: 100%;
    backface-visibility: hidden;
    vertical-align: top;
}

.snip figcaption {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.snip h3,
.snip h5 {
    margin: 0;
    opacity: 0;
    letter-spacing: 1px;
}

.snip h3 {
    -webkit-transform : translateY(-100%);
    transform : translateY(-100%);
    text-transform: uppercase;
    font-weight: 400;
    -webkit-transition-delay: 0.05s;
    transition-delay: 0.05s;
    margin-bottom: 5px;
}

.snip h5 {
    font-weight: 400;
    background-color: #A0A0A0;
    padding: 3px 10px;
    -webkit-transform : translateY(100%);
    transform : translateY(100%);
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
}

.snip a {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.snip:hover:before,
.snip.hover:before {
    top: 10px;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
}

.snip:hover h3,
.snip.hover h3,
.snip:hover h5,
.snip.hover h5 {
    opacity: 1;
    -webkit-transform : translateY(0);
    transform : translateY(0);
}
</style>
