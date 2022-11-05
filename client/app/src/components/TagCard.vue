<template>
  <div @click="() => this.$router.push(`/tags/${tag.name}`)" class="flex items-center justify-center border border-gray-300 dark:border-gray-600 dark:bg-gray-800 cursor-pointer rounded-md p-3 dark:text-white break-all">
    <p>
      {{ tag.name }}
    </p>
  </div>
</template>

<script>

export default {
  props: {
    tag: {}
  }
}
  
</script>
