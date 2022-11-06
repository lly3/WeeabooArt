<template>
  <div @click="() => this.$router.push(`/tags/${tag.name}`)" class="flex items-center cursor-pointer h-24 justify-center grow-0 shrink-0 md:basis-1/5 basis-1/3 overflow-hidden relative hover:scale-110 duration-150 ease-in-out">
    <p v-if="tag.image == 'default.png'" class="z-10 dark:text-white md:text-lg font-bold break-all ">
      {{ tag.name }}
    </p>
    <p v-else class="z-10 text-white md:text-lg font-bold break-all ">
      {{ tag.name }}
    </p>
    <img :src="imageURL(tag.image)" alt="No Image" class="w-full brightness-90 absolute object-cover aspect-video p-1" />
  </div>
</template>

<script>

export default {
  props: {
    tag: {}
  },
  methods: {
    imageURL(url) {
      return "http://localhost/images/" + url
    }
  }
}
  
</script>
