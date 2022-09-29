<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Navbar from './components/layouts/navbar.vue'
import Profile  from '@/components/profile/Profile.vue'
</script>

<template>
  <header>
    <Navbar />
<!--    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />-->

<!--    <div class="wrapper">-->
<!--      <HelloWorld msg="You did it!" />-->

<!--      <nav>-->
<!--        <RouterLink to="/">Home</RouterLink>-->
<!--        <RouterLink to="/about">About</RouterLink>-->
<!--        <RouterLink to="/rewards">Rewards</RouterLink>-->
<!--        <Profile></Profile>-->
<!--        <RouterLink to="/register">Register</RouterLink>-->
<!--      </nav>-->
<!--    </div>-->
  </header>

  <RouterView />
</template>

