import {createRouter, createWebHistory} from 'vue-router'
import LoginView from '../views/LoginView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/login',
            name: 'login',
            component: () => import('../views/LoginView.vue'),
        },
        {
            path: '/',
            name: 'dashboard',
            component: () => import('../views/DashboardView.vue'),
        },
        {
            path: '/history',
            name: 'history',
            component: () => import('../views/HistoryView.vue'),
        },
    ],
})

export default router
