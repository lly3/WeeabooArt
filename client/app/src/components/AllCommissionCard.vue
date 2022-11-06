<template>
        <section class="overflow-hidden text-gray-700">
            <div class="container px-5 py-2 mx-auto lg:py-4 lg:px-12 grid lg:grid-cols-5 sm:grid-cols-2 gap-4">
                <commission-card v-for="commission in commissions" :commission="{ ...commission }" :key="commission.id"></commission-card>
            </div>
        </section>
    </template>
    
    <script>
    import CommissionCard from '@/components/CommissionCard.vue'
    export default {
        data() {
            return {
                commissions: ''
            }
        },
        components: {
            CommissionCard
        },
        props: {
            commissions: Array,
        }
    }
    </script>
