<template>
    <div class="container mx-auto px-4">

        <!--     @if (session('alert'))
                  <p>{{ session('alert') }}</p>
            @endif -->

        <h1 class="dark:text-white text-2xl font-bold text-gray-700 px-6 md:px-0">Update Profile</h1>
        <ul class="flex border-b border-gray-300 font-medium text-gray-600 mt-3 px-6 md:px-0">
            <li class="dark:text-gray-600 mr-8 hover:text-gray-900"><a @click="() => this.$router.push('/update-profile')" class="cursor-pointer py-4 inline-block">Profile Info</a></li>
            <li class="dark:text-white mr-8 text-gray-900 border-b-2 border-gray-800"><a href="#" class="py-4 inline-block">Password</a></li>
            <li class="dark:text-gray-600 mr-8 text-gray-900 border-b-2 border-gray-800"><a @click="() => this.$router.push('/update-profile-picture')"
                                                                         class="cursor-pointer py-4 inline-block">Profile Picture</a></li>
        </ul>
        <form @submit.prevent="onFormSave()">
            <!-- @csrf -->
            <div class="w-full bg-white rounded-lg mx-auto mt-8 flex overflow-hidden rounded-b-none">
                <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                    <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Change Password</h2>
                    <p class="text-gray-500">Update your password.</p>
                </div>
                <div class="md:w-2/3 w-full pb-8">
                    <div class="py-8 px-16">

                        <label for="current_password" class="text-gray-600">Current Password</label>
                        <input v-model="current_password" class="mt-2 border-2 border-gray-200 px-3 py-2
                        block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                               type="password" placeholder="Current Password" name="current_password">

                        <label for="password" class="text-gray-600">New Password</label>
                        <input v-model="password" class="mt-2 border-2 border-gray-200 px-3 py-2
                        block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                               type="password" placeholder="New Password" name="password">

                        <label for="password_confirmation" class="text-gray-600">New Password Confirmation</label>
                        <input v-model="password_confirmation" class="mt-2 border-2 border-gray-200 px-3 py-2
                        block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500"
                               type="password" name="password_confirmation" placeholder="New Password Confirmation">
                    </div>
                    <div class="px-16">
                        <label v-if="message" for="email" class="text-greenlogo">{{ this.message }}</label>
                        <label v-if="error" for="email" class="text-red-700">{{ this.error }}</label>
                    </div>

                </div>
            </div>
            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200 flex justify-between">
                <p class="float-left text-gray-500 tracking-tight mt-2">Click on Save to update your Password</p>
                <!--                    <input type="submit" class="bg-greenlogo text-black text-sm font-medium px-6 py-2 rounded float-right my-auto uppercase cursor-pointer" value="Save">-->
                <button type="submit" class="shadow bg-greenlogo hover:bg-secondaryfont duration-200 ease-in focus:shadow-outline focus:outline-none font-semibold py-1.5 px-4 rounded">SAVE</button>
            </div>
        </form>
    </div>
</template>
<script>
import { useAuthStore } from '@/stores/auth.js'
export default {
    setup() {
        const auth_store = useAuthStore()
        return { auth_store }
    },
    mounted() {
        if(!this.auth_store.isAuthen)
            return this.$router.push('/login')
    },
    data() {
        return {
            current_password: '',
            password: '',
            password_confirmation: '',
            error: null,
            message: null
        }
    },
    methods: {
        async onFormSave() {
            try {
                console.log(this.name, this.email)
                this.error = null
                this.message = null

                const response = await this.$axios.post('/auth/update-password', {
                    current_password: this.current_password,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("jwt_token")}`
                    }
                })
                if (response.status == 200) {
                    this.message = response.data.message
                    this.auth_store.fetch()
                    // this.$router.push('/update-profile')
                }
            } catch (error) {
                console.log(error)
                this.error = error.response.data
            }
        }
    }
}
</script>

<style scoped>
#menu-toggle:checked + #menu {
    display: block;
}
</style>
