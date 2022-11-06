<template>
    <div class="">
        <button id="my-button" @click=action class="shadow bg-greenlogo hover:bg-secondaryfont duration-200 ease-in focus:shadow-outline focus:outline-none text-{{ textColor }} font-semibold py-1.5 px-4 rounded" type="button">
            {{ title }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        textColor: {
            default: 'white',
            type: String
        },
        action: {
            type: Function
        }
    }
}
</script>
