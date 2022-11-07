<template>
    <div class="container mx-auto px-4 min-h-screen">

        <!--     @if (session('alert'))
                  <p>{{ session('alert') }}</p>
            @endif -->

        <h1 class="dark:text-white text-2xl font-bold text-gray-700 px-6 md:px-0">Update Profile</h1>
        <ul class="flex border-b border-gray-300 font-medium text-gray-600 mt-3 px-6 md:px-0">
            <li class="dark:text-gray-600 mr-8 hover:text-gray-900"><a @click="() => this.$router.push('/update-profile')" class="cursor-pointer py-4 inline-block">Profile Info</a></li>
            <li class="dark:text-gray-600 mr-8 hover:text-gray-900"><a @click="() => this.$router.push('/update-password')" class="cursor-pointer py-4 inline-block">Password</a></li>
            <li class="dark:text-white mr-8 text-gray-900 border-b-2 border-gray-800"><a href="#" class="py-4 inline-block">Profile Picture</a></li>
        </ul>
        <form @submit="onFormSave">
            <!-- @csrf -->
            <div class="w-full bg-white rounded-lg mx-auto mt-8 flex overflow-hidden rounded-b-none">
                <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                    <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Change Profile picture</h2>
                    <p class="text-gray-500">Update your Profile picture.</p>
                </div>
                <div class="md:w-2/3 w-full pb-8">
                    <div class="py-8 px-16 clearfix">
                        <label for="photo" class="text-gray-600 w-full block">Picture</label>
                        <img class="rounded-full w-16 h-16 border-4 mt-2 border-gray-200 float-left" id="photo" :src=imageURL alt="photo">
                        <div class="bg-gray-200 text-gray-500 mt-5 ml-3 font-bold px-4 py-2 rounded-lg float-left hover:bg-gray-300 hover:text-gray-600 relative overflow-hidden cursor-pointer">
                            <input type="file" name="image" id="browse" @change="previewImage" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"> Change Picture
                        </div>
                    </div>

                    <div class="mx-16 my-8">
<!--                        <label class="text-greenlogo"> this.message </label>-->
                        <label v-if="message" class="text-greenlogo">{{ this.message }}</label>
                        <label v-if="error" class="text-red-700">{{ this.error }}</label>
                    </div>
                </div>
            </div>
            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200 flex justify-between">
                <p class="float-left text-gray-500 tracking-tight mt-2">Click on Save to update your Profile picture</p>
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
            image: null,
            imageURL: null,
            message: null,
            error: null
        }
    },
    created() {
        this.imageURL = this.getImageURL(this.auth_store.getImage)
    },
    methods: {
        getImageURL(path) {
            return import.meta.env.VITE_BACKEND_IMG_URL + '/' + path
        },
        async uploadImage() {
            const formData = new FormData();
            formData.append('image', this.image)
            return await this.$axios.post('/image', formData, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("jwt_token")}`,
                }
            }).then(res => res.data.image_id)
        },
        previewImage(e) {
            this.image = e.target.files[0]
            this.imageURL = URL.createObjectURL(e.target.files[0])
        },
        async onFormSave(e) {
            e.preventDefault();
            try {
                this.error = null
                this.message = null

                const imageID = await this.uploadImage()
                const response = await this.$axios.post('/auth/update-profile-picture', {
                    image_id: imageID
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("jwt_token")}`
                    }
                })
                if (response.status == 200) {
                    this.message = response.data.message
                    this.auth_store.fetch()
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
