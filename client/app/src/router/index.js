import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CoinDeskView from '@/views/CoinDeskView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView
    // },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/coin-desk',
      name: 'coin-desk',
      component: CoinDeskView
    },
    {
      path: '/rewards',
      name: 'rewards',
      component: () => import('@/views/rewards/AllRewardView.vue')
    },
    {
      path: '/rewards/:id',
      name: 'rewards.show',
      component: () => import('@/views/rewards/DetailView.vue')
    },
    {
      path: '/rewards/create',
      name: 'rewards.create',
      component: () => import('@/views/rewards/CreateView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/LoginView.vue')
    },
    {
      path: '/post/create',
      name: 'post.create',
      component: () => import('@/views/posts/CreateView.vue')
    },
    {
      path: '/post/:id',
      name: 'post.show',
      component: () => import('@/views/posts/ShowView.vue')
    },
    {
      path: '/post/edit/:id',
      name: 'post.edit',
      component: () => import('@/views/posts/EditView.vue')
    },
    {
        path: '/logout',
        name: 'logout',
        component: () => import('@/views/LogoutView.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/RegisterView.vue')
    },
    {
        path: '/',
        name: 'gallery',
        component: () => import('@/views/GalleryView.vue')
    },
    {
        path: '/post/search/:searchKey',
        name: 'post.search',
        component: () => import('@/views/SearchView.vue')
    },
    {
        path: '/my-collection',
        name: 'my-collection',
        component: () => import('@/views/MyCollectionView.vue')
    },
    {
        path: '/forgot-password',
        name: 'forgot-password',
        component: () => import('@/views/ForgotPasswordView.vue')
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: () => import('@/views/ResetPasswordView.vue')
    },
    {
        path: '/profile/:id',
        name: 'show.profile',
        component: () => import('@/views/profiles/AuthorPostsView.vue')
    },
    {
      path: '/commission/create',
      name: 'commission.create',
      component: () => import('@/views/commissions/CreateView.vue')
    },
    {
      path: '/commission/:id',
      name: 'commission.show',
      component: () => import('@/views/commissions/ShowView.vue')
    },
    {
      path: '/commission/edit/:id',
      name: 'commission.edit',
      component: () => import('@/views/commissions/EditView.vue')
    }
  ]
})

export default router
