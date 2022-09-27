<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Navbar from './components/layouts/navbar.vue'
</script>

<template>
  <header>
    <Navbar />
  </header>
  <div class="dark:bg-gray-900 ease-out duration-300">
    <RouterView />
  </div>
</template>

