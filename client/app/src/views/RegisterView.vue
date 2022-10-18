<template>
    <auth-card>
        <Register>
            <h2 class="text-3xl font-extrabold mb-3">Register</h2>

            <span class="font-bold">Name</span>
            <div>
                <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Name"
                v-model="name">
                <p v-if="name_error!=null" class="pb-4 text-red-600">{{ name_error }}</p>
            </div>

            <span class="font-bold">Email</span>
            <div>
                <input type="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4" placeholder="Email"
                v-model="email">
                <p v-if="email_error!=null" class="pb-4 text-red-600">{{ email_error }}</p>
            </div>

            <span class="font-bold">Birth Date</span>
            <div>
                <input type="date" min="1950-01-01" :max=today
                       class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo mb-4"
                v-model="date_of_birth">
                <p v-if="birth_date_error!=null" class="pb-4 text-red-600">{{ birth_date_error }}</p>
            </div>

            <span class="font-bold">Image</span>
            <div>
                <img :src="imageURL" class="block h-full object-contain mx-auto">
                <input type="file" name="image_id" id="browse"
                       class="appearance-none rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-greenlogo"
                @change="previewImage">
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
                    <button @click="register()" class="shadow bg-greenlogo hover:bg-secondaryfont focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                        Register
                    </button>
                </div>

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="http://localhost:3000/login">
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
            date_of_birth: '',
            image_id: 0,
            password: '',
            password_confirmation: '',
            error: null,
            name_error: null,
            email_error: null,
            password_error: null,
            birth_date_error: null,
            today: new Date().toISOString().substr(0, 10),
            imageURL: null,
        }
    },
    methods: {
        uploadImage() {
            const formData = new FormData();
            formData.append('image', this.image_id)
            return this.$axios.post('/image', formData)
        },
        previewImage(event) {
            this.image_id = event.target.files[0]
            this.imageURL = URL.createObjectURL(event.target.files[0])
        },
        async register() {
            try {
                const response_image = await this.uploadImage();
                const imageID = response_image.data.image_id

                console.log(this.name, this.email, this.date_of_birth, imageID, this.password, this.password_confirmation)
                this.error = null

                // const auth_id = await this.auth_store.register(this.name, this.email, this.password, this.password_confirmation)

                const response = await this.$axios.post('/auth/register', {
                    name: this.name,
                    email: this.email,
                    date_of_birth: this.date_of_birth,
                    image_id: (imageID == undefined) ? 1 : imageID,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                if (response.status == 201) {
                    this.$router.push('/login')
                }

            } catch (error) {
                console.log(error)
                this.error = error.message

                if (error.response.data.name != undefined) {
                    this.name_error = error.response.data.name[0]
                }

                if (error.response.data.email != undefined) {
                    this.email_error = error.response.data.email[0]
                }

                if (error.response.data.date_of_birth != undefined) {
                    this.birth_date_error = error.response.data.date_of_birth[0]
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
