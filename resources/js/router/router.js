import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/layout/Home";
import Login from "../views/auth/Login";
import Registration from "../views/auth/Registration";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/user/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/user/register",
        name: "Registration",
        component: Registration,
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL),
});

export default router;
