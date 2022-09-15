<template>
  <div class="mx-8">
    <h1 class="text-3xl text-yellow-700">{{ title }}</h1>

    <div v-if="error != null">
      {{ error }}
    </div>

    <reward-card v-for="reward in rewards" :key="reward.id" 
            :reward="{...reward}" :url="`rewards/${reward.id}`">
    {{ reward.detail }}
    <template #total_amount>จำนวนจำกัด {{ reward.total_amount }} สิทธิ์</template>
    </reward-card>

    {{ selected }}
  </div>
</template>

<script>
import RewardCard from '@/components/rewards/RewardCard.vue'
export default {
  data() {
    return {
      title: "Rewards",
      selected: null,
      rewards: null,
      error: null
    }
  },
  components: {
    RewardCard
  },
  methods: {
    selectReward(reward) {
      console.table(reward)
      this.$router.push(`rewards/${reward.id}`)
    }
  },
  async mounted() {
    try {
      this.error = null
      const response = await this.$axios.get('/rewards');
      this.rewards = response.data.data
    } catch(error) {
      console.log(error)
      this.error = error.message
    }
    
    
  }
}
</script>

<style scoped>

</style>