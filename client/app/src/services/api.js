import axios from 'axios'

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL + '/api'
})

const JWT_TOKEN_LOCALSTORAGE_KEY = 'jwt_token'
const token = localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)

axiosInstance.defaults.headers.common['Accept'] = 'application/json;charset=UTF-8';
axiosInstance.defaults.headers.common['Content-Type'] = 'application/json;charset=UTF-8';
if (token) {
    axiosInstance.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

export const authAPI = {
    async login (email, password) {
        const response = await axiosInstance.post('/auth/login', {
            email,
            password
        })
        if (response.status == 200) {
            localStorage.setItem(JWT_TOKEN_LOCALSTORAGE_KEY, response.data.access_token)
            return true
        }
        return false
    },
    async me () {
        const _token = localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)
        if (_token) {
            axiosInstance.defaults.headers.common['Authorization'] = 'Bearer ' + _token
        }
        const response = await axiosInstance.post('/auth/me')
        if (response.status == 200) {
            return response.data.data
        }
        return {}
    },
    logout () {
        localStorage.removeItem(JWT_TOKEN_LOCALSTORAGE_KEY)
    },
    async register (name, email, password, password_confirmation) {
        const response = await axiosInstance.post('/auth/register', {
            name,
            email,
            password,
            password_confirmation
        })
        if (response.status == 201) {
            return response.data
        }
        return {
            success: false,
        }
    }
}

export const postAPI = {
    createPost(post) {
        return axiosInstance.post('/post', post)
    },
    transaction(id) {
        return axiosInstance.get(`/post/transaction/${id}`)
    },
    premiumDownload(id) {
        return axiosInstance.get(`/post/premium_download/${id}`, {responseType: 'arraybuffer'})
    },
    paginate(pageNumber, type='art_post') {
        return axiosInstance.get(`/post/?page=${pageNumber}&type=${type}`)
    },
    mostLiked() {
        return axiosInstance.post('/post/mostLiked')
    },
    mostViewed() {
        return axiosInstance.post('/post/mostViewed')
    },
    fetch() {
        return axiosInstance.get('/post')
    },
    editView(id) {
        return axiosInstance.get(`/post/edit/${id}`)
    },
    edit(id, post) {
        return axiosInstance.put(`/post/${id}`, post)
    },
    delete(id) {
        return axiosInstance.delete(`/post/${id}`)
    },
    show(id) {
        return axiosInstance.get(`/post/${id}`)
    },
    collected(id) {
        return axiosInstance.get(`/post/collected/${id}`)
    },
    more_by(user_id, quantity='', random=false) {
        return axiosInstance.get(`/post/by/${user_id}?quantity=${quantity}&ramdom=${random}`)
    },
    favorited(id) {
        return axiosInstance.get(`/post/favorited/${id}`)
    }

}

export const commissionAPI = {
    editView(id) {
        return axiosInstance.get(`/commission/edit/${id}`)
    },
    edit(id, post) {
        return axiosInstance.put(`/commission/${id}`, post)
    },
    delete(id) {
        return axiosInstance.delete(`/commission/${id}`)
    },
    show(id) {
        return axiosInstance.get(`/commission/${id}`)
    },
    create(post) {
        return axiosInstance.post('/commission', post)
    },
    more_by(user_id, quantity='', random=false) {
        return axiosInstance.get(`/commission/by/${user_id}?quantity=${quantity}&ramdom=${random}`)
    },
    paginate(pageNumber) {
        return axiosInstance.get(`/commission/?page=${pageNumber}`)
    },
    fetch() {
        return axiosInstance.get('/commission')
    },
}

export const imageAPI = {
    async uploadImage(image) {
        try {
            const formData = new FormData();
            formData.append('image', image)
            return axiosInstance.post('/image', formData).then(res => res.data.image_id)
        } catch (e) {
            console.log(e);
        }
    },
    async uploadImages(images) {
      const formData = new FormData();
      for (let i = 0; i < images.length; i++) {
        formData.append('images[]', images[i])
      }
      const response = await axiosInstance.post('/images', formData)
      console.log(response);
      return response.data.data;
    }
}

export const tagAPI = {
    paginate(tag, pageNumber, quantity=0) {
        return axiosInstance.get(`/tags/${tag}?page=${pageNumber}&quantity=${quantity}`);
    },
    fetch() {
        return axiosInstance.get('/tags')
    }
}

export const commentAPI = {
    commissionComment(message, commission_id) {
        return axiosInstance.post(`/comment/commission`, { message, commission_id });
    },
}
