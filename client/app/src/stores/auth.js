import { defineStore } from 'pinia'
import { authAPI } from '@/services/api'

const auth_storage = {
    id: localStorage.getItem('auth.id'),
    email: localStorage.getItem('auth.email'),
    name: localStorage.getItem('auth.name'),
    image: localStorage.getItem('auth.image'),
}

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => {
        return {
            auth: {
                id: auth_storage.id,
                email: auth_storage.email,
                name: auth_storage.name,
                image: auth_storage.image
            }
        }
    },

    getters: {
        getAuth: (state) => state.auth,

        getId: (state) => state.auth.id,

        getEmail: (state) => state.auth.email,

        getName: (state) => state.auth.name,

        getImage: (state) => state.auth.image,

        isAuthen (state) {
            return state.auth.email != null
        }
    },

    actions: {
        async login (email, password) {
            if (await authAPI.login(email, password)) {
                this.fetch()
                return true
            }
            return false
        },

        async fetch () {
            this.auth = await authAPI.me()
            localStorage.setItem('auth.id', this.auth.id)
            localStorage.setItem('auth.email', this.auth.email)
            localStorage.setItem('auth.name', this.auth.name)
            localStorage.setItem('auth.image', this.auth.image)
        },

        logout () {
            authAPI.logout()
            localStorage.removeItem('auth.id')
            localStorage.removeItem('auth.email')
            localStorage.removeItem('auth.name')
            localStorage.removeItem('auth.image')
            this.auth = {
                email: null,
            }
        },

        async register (name, email, password, password_confirmation) {
            const response = await authAPI.register(name, email, password)
            if (response.success) {
                this.auth.push({
                    name, email, password, password_confirmation
                })
                return response.auth_id
            }
            return false
        }
    }
})
