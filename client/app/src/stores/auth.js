import { defineStore } from 'pinia'
import { authAPI } from '@/services/api'

const auth_storage = {
    email: localStorage.getItem('auth.email'),
    name: localStorage.getItem('auth.name'),
}

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => {
        return {
            auth: {
                email: auth_storage.email,
                name: auth_storage.name,
            }
        }
    },

    getters: {
        getAuth: (state) => state.auth,

        getEmail: (state) => state.auth.email,

        authName: (state) => state.auth.name,

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
            localStorage.setItem('auth.email', this.auth.email)
            localStorage.setItem('auth.name', this.auth.name)
        },

        logout () {
            authAPI.logout()
            localStorage.removeItem('auth.email')
            localStorage.removeItem('auth.name')
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
