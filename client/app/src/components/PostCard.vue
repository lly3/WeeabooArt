<template>
    <div class="w-full justify-center flex">
        <a :href=concatFunction class="button-container">
            <img alt="No Image" class="rounded-lg normal_image"
                 :src=concatFunctionImage>
            <button class="m-4 btn-glow h-6 px-4 sm:h-8 sm:px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 13 13"
                     stroke="currentColor">
                    <path d="M6.99999 11.8709L6.15416 11.1009C3.14999 8.37675 1.16666 6.57425 1.16666 4.37508C1.16666 2.57258 2.57832 1.16675 4.37499 1.16675C5.38999 1.16675 6.36416 1.63925 6.99999 2.38008C7.63582 1.63925 8.60999 1.16675 9.62499 1.16675C11.4217 1.16675 12.8333 2.57258 12.8333 4.37508C12.8333 6.57425 10.85 8.37675 7.84582 11.1009L6.99999 11.8709Z" fill="#F85486"></path>
                </svg>
                <span class="text-black text-[12px] pl-1 font-semibold hidden sm:block">{{ post.favorite_count}}</span>
            </button>
        </a>
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
</style>
