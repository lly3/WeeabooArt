<template>
    <div class="container mx-auto ">

        <!--     @if (session('alert'))
                  <p>{{ session('alert') }}</p>
            @endif -->

        <h1 class="text-2xl font-bold text-gray-700 px-6 md:px-0">Update Profile</h1>
        <ul class="flex border-b border-gray-300 font-medium text-gray-600 mt-3 px-6 md:px-0">
            <li class="mr-8 text-gray-900 border-b-2 border-gray-800"><a href="#_" class="py-4 inline-block">Profile Info</a></li>
            <li class="mr-8 hover:text-gray-900"><a href="#_" class="py-4 inline-block">Password</a></li>
        </ul>
        <form @submit.prevent="onFormSave()">
            <!-- @csrf -->
            <div class="w-full bg-white rounded-lg mx-auto mt-8 flex overflow-hidden rounded-b-none">
                <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                    <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Profile Info</h2>
                    <p class="text-gray-500">Update your basic profile information such as Email Address, Name, and Image.</p>
                </div>
                <div class="md:w-2/3 w-full pb-8">
                    <div class="py-8 px-16">
                        <label for="name" class="text-gray-600">Name</label>
                        <input v-model="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" :placeholder="this.auth_store.getName" name="name">
                    </div>
                    <hr class="border-gray-200">
                    <div class="py-8 px-16">
                        <label for="email" class="text-gray-600">Email Address</label>
                        <input v-model="email" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="email" name="email" :placeholder="this.auth_store.getEmail">
                    </div>
                    <hr class="border-gray-200">
                    <div class="py-8 px-16 clearfix">
                        <label for="photo" class="text-gray-600 w-full block">Photo</label>
                        <img class="rounded-full w-16 h-16 border-4 mt-2 border-gray-200 float-left" id="photo" :src=imageURL alt="photo">
                        <div class="bg-gray-200 text-gray-500 mt-5 ml-3 font-bold px-4 py-2 rounded-lg float-left hover:bg-gray-300 hover:text-gray-600 relative overflow-hidden cursor-pointer">
                            <input type="file" name="photo" @change="previewImage" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"> Change Photo
                        </div>
                    </div>

                </div>
            </div>
            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200 flex justify-between">
                <p class="float-left text-gray-500 tracking-tight mt-2">Click on Save to update your Profile Info</p>
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
            name: '',
            email: '',
            image: null,
            imageURL: null,
            error: null
        }
    },
    created() {
        this.imageURL = this.getImageURL(this.auth_store.getImage)
    },
    methods: {
        getImageURL(path) {
            return 'http://localhost/images/' + path
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
        previewImage(event) {
            this.image = e.target.files[0]
            this.imageURL = URL.createObjectURL(e.target.files[0])
            // this.getImageURL(this.imageURL)
        },
        async onFormSave() {
            try {
                console.log(this.name, this.email)
                this.error = null

                const imageID = await this.uploadImage()
                const response = await this.$axios.post('/auth/update-profile', {
                    name: this.name,
                    email: this.email,
                    image_id: (imageID == undefined) ? 0 : imageID
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("jwt_token")}`
                    }
                })
                if (response.status == 200) {
                    this.$router.push('/update-profile')
                }
            } catch (error) {
                console.log(error)
                this.error = error.message
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
