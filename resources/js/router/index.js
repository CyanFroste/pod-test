import { createWebHistory, createRouter } from 'vue-router'
import Home from '../views/Home.vue'
import About from '../views/About.vue'
import ApiTest from '../views/ApiTest.vue'
import { ROOT_PATH } from '../common'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/about',
        name: 'About',
        component: About,
    },
    {
        path: '/api-test',
        name: 'ApiTest',
        component: ApiTest,
    },
]

const router = createRouter({
    history: createWebHistory(ROOT_PATH),
    routes,
})

export default router
