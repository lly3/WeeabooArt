<template>
    <div class="w-1/2 p-1 md:p-2">
        <img alt="No Image" class="block object-cover object-center w-full h-full rounded-lg"
             src="{{ image_path }}">
    </div>
</template>

<script>
export default {
    name: 'ImageCard',
    props: {
        image_path: {
            type: String,
            required: true
        }
    }
}
</script>
