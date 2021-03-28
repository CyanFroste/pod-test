import { createWebHistory, createRouter } from 'vue-router'
import Home from '../views/Home.vue'
import Movies from '../views/Movies.vue'
import CreateMovie from '../views/CreateMovie.vue'
import { ROOT_PATH } from '../common'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/movies',
        name: 'Movies',
        component: Movies,
        children: [
            {
                path: 'create',
                component: CreateMovie,
                name: 'CreateMovie',
                props: true,
                meta: {
                    show: true,
                },
            },
        ],
    },
]

const router = createRouter({
    history: createWebHistory(ROOT_PATH),
    routes,
})

export default router
