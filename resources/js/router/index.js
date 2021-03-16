import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import ApiTest from "../views/ApiTest.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/api-test",
        name: "ApiTest",
        component: ApiTest,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
