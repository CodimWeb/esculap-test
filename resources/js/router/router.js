import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/registration',
        name: 'registration',
        component: () => import('../views/Registration.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../views/Login.vue')
    },
    {
        path: '/news/:id',
        name: 'news-detail',
        component: () => import('../views/News.vue')
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const accessToken = localStorage.getItem('access_token');
    if(accessToken) {
        next()
    }
    else {
       if(to.path === "/registration" || to.path === '/login') {
           next()
       }
       else {
           return next({path: '/login'})
       }
    }
})

export default router
