<template>
        <auth-card>
            <Login>
                <h2 class="text-3xl font-extrabold mb-3">Login</h2>

                <span class="font-bold">Email</span>
                <form @submit.prevent="onFormLogin()">
                    <div>
                        <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Email"
                        v-model="email" required autocomplete="off">
                    </div>

                    <span class="font-bold">Password</span>
                    <div>
                        <input type="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Password"
                        v-model="password" required>
                    </div>

                    <div class="block mb-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-greenlogo shadow-sm focus:border-greenlogo focus:ring focus:ring-secondaryfont focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="md:flex md:items-center">

                        <div class="md:w-1/3">
                            <button type="submit" :disabled="disabledButton" class="shadow bg-greenlogo hover:bg-secondaryfont focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                Log In
                            </button>
                            <p v-if="error" class="pb-4 pt-4 text-red-600">{{ error }}</p>
                        </div>
                        <a @click="() => this.$router.push('/forgot-password')" class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
                            Forgot your password?
                        </a>

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
            password: '',
            error: null,
            disabledButton: false,
            message_error: null
        }
    },
    methods: {
        async onFormLogin() {
            this.error = null
            this.disabledButton = true
            try {
                if (await this.auth_store.login(this.email, this.password)) {
                    this.$router.push('/')
                } else {
                    this.disabledButton = false
                }
            } catch (error) {
                console.log(error)
                this.error = error.response.data.error
                this.disabledButton = false
            }
        }
    },
}
</script>

