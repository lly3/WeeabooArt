<template>
    <auth-card>
        <Register>
            <h2 class="text-3xl font-extrabold mb-3">Reset Password</h2>

            <span class="font-bold">Email</span>
            <div>
                <input type="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Email"
                       v-model="email">
                <p v-if="email_error!=null" class="pb-4 text-red-600">{{ email_error }}</p>
            </div>

            <span class="font-bold">Reset Password Token</span>
            <div>
                <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Reset Password Token"
                       v-model="reset_password_token">
                <p v-if="reset_password_token_error!=null" class="pb-4 text-red-600">{{ reset_password_token_error }}</p>
            </div>

            <span class="font-bold">Password</span>
            <div>
                <input type="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Password"
                       v-model="password">
            </div>

            <span class="font-bold">Confirm Password</span>
            <div>
                <input type="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Confirm Password"
                       v-model="password_confirmation">
                <p v-if="password_error!=null" class="pb-4 text-red-600">{{ password_error }}</p>

            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-2/3">
                    <button @click="resetPassword()" class="shadow bg-greenlogo hover:bg-secondaryfont focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                        Reset Password
                    </button>
                    <p v-if="error_message" class="pt-4 pb-4 text-red-600">{{ error_message }}</p>
                </div>
            </div>

        </Register>
    </auth-card>
</template>

<script>
import AuthCard from '@/components/AuthCard.vue'
import { useAuthStore } from '@/stores/auth.js'
export default {
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },
    mounted() {
        if(this.auth_store.isAuthen) {
            return this.$router.push('/')
        }
    },
    components: {
        AuthCard
    },
    data() {
        return {
            email: '',
            reset_password_token: '',
            password: '',
            password_confirmation: '',
            error: null,
            email_error: null,
            reset_password_token_error: null,
            password_error: null,
            error_message: null
        }
    },
    methods: {
        async resetPassword() {
            try {
                console.log(this.email,  this.reset_password_token, this.password, this.password_confirmation)
                this.error = null
                this.email_error = null
                this.reset_password_token_error = null
                this.password_error = null
                this.error_message = null

                const response = await this.$axios.post('/auth/reset-password', {
                    email: this.email,
                    reset_password_token: this.reset_password_token,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })

                if (response.status == 200) {
                    this.$router.push('/login')
                }

            } catch (error) {
                console.log(error)
                // this.error = error.message

                if (error.response.data.error != undefined) {
                    this.error_message = error.response.data.error
                }

                if (error.response.data.email != undefined) {
                    this.email_error = error.response.data.email[0]
                }

                if (error.response.data.reset_password_token != undefined) {
                    this.reset_password_token_error = error.response.data.reset_password_token[0]
                }

                if (error.response.data.password != undefined) {
                    this.password_error = error.response.data.password[0]
                }
            }
        }
    }
}

</script>
<style>
input::file-selector-button {
    /*font-weight: bold;*/
    /*color: dodgerblue;*/
    /*border: thin solid grey;*/
    border-radius: 4px;
    /*margin-left: 10px;*/
    /*margin-right: 32px;*/
}
</style>
