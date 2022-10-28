<template>
    <auth-card>
        <Login>
            <h2 class="text-3xl font-extrabold mb-3">Forgot your password ?</h2>
            <p class="font-light mb-3">No problem. Just let us know your email address and we will email you a reset password token that will allow you to choose a new one.</p>
            <p v-if="error" class="pb-4 text-red-600">{{ error }}</p>
            <p v-if="message" class="pb-4 text-greenlogo">{{ message }}</p>
            <span class="font-bold">Email</span>
            <form v-on:submit.prevent="onSubmit">
                <div>
                    <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Email"
                           v-model="email" required autocomplete="off">
                </div>

                <div class="md:flex md:items-center">

                    <div class="">
                        <button type="submit" :disabled="disabledButton" class="shadow bg-greenlogo hover:bg-secondaryfont focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                            Email Password Reset Link
                        </button>
                    </div>

                </div>
            </form>

        </Login>
    </auth-card>
</template>

<script>
import AuthCard from '@/components/AuthCard.vue'
import { useAuthStore } from '@/stores/auth.js'

export default {
    components: {
        AuthCard
    },
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },
    mounted() {
        if(this.auth_store.isAuthen) {
            return this.$router.push('/')
        }
    },
    data() {
        return {
            email: '',
            error: null,
            disabledButton: false,
            message: null,
        }
    },
    methods: {
        async onSubmit() {
            this.disabledButton = true
            this.error = null
            this.message = null
            try {
                const response = await this.$axios.post('/auth/forgot-password', {
                    email: this.email,
                })
                this.message = response.data.message
            } catch (e) {
                this.error = e.response.data.error
                this.disabledButton = false
            }
            this.disabledButton = false
        }
    },
}
</script>

