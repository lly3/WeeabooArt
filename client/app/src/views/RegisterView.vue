<template>
    <auth-card>
        <Register>
            <h2 class="text-3xl font-extrabold mb-3">Register</h2>

            <span class="font-bold">Name</span>
            <div>
                <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Name"
                v-model="name">
            </div>

            <span class="font-bold">Email</span>
            <div>
                <input type="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Email"
                v-model="email">
                <p v-if="email_error!=null" class="pb-4 text-red-600">The email has already been taken.</p>
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
                <p v-if="password_error!=null" class="pb-4 text-red-600">The password confirmation does not match.</p>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-2/3">
                    <button @click="register()" class="shadow bg-greenlogo hover:bg-secondaryfont focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                        Register
                    </button>
                </div>

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
                    Already registered?
                </a>

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
    components: {
        AuthCard
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            error: null,
            email_error: null,
            password_error: null,
        }
    },
    methods: {
        async register() {
            try {
                console.log(this.name, this.email, this.password, this.password_confirmation)
                this.error = null
                // const auth_id = await this.auth_store.register(this.name, this.email, this.password, this.password_confirmation)
                const response = await this.$axios.post('/auth/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                if (response.status == 201) {
                    this.$router.push('/login')
                }

            } catch (error) {
                console.log(error)
                this.error = error.message

                if (error.response.data.email == undefined) {
                    this.password_error = error.response.data.password[0]
                }
                if (error.response.data.password == undefined) {
                    this.email_error = error.response.data.email[0]
                }
            }
        }
    }
}
</script>
