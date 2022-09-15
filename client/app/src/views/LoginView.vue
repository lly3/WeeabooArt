<template>
        <auth-card>
            <Login>
                <h2 class="text-3xl font-extrabold mb-3">Login</h2>

                <span class="font-bold">Username</span>
                <div>
                    <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Username">
                </div>

                <span class="font-bold">Password</span>
                <div>
                    <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Password">
                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-2/3">
                        <button class="shadow bg-greenlogo hover:bg-secondaryfont focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                            Sign In
                        </button>
                    </div>
                </div>

            </Login>
        </auth-card>
</template>

<script>
import AuthCard from '@/components/AuthCard.vue'
export default {
    components: {
        AuthCard
    },
    data() {
        return {
        email: '',
        password: '',
        error: null
        }
    },
    methods: {
        async login() {
        try {
            this.error = null
            const response = await this.$axios.post('/login', {
            email: this.email,
            password: this.password
            })
            this.$store.commit('setToken', response.data.token)
            this.$router.push('/')
        } catch(error) {
            console.log(error)
            this.error = error.message
        }
        }
    }
}
</script>

