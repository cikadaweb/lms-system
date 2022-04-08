import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/layout/Home";
import Login from "../views/auth/Login";
import Registration from "../views/auth/Registration";
import UsersDashboard from "../views/layout/Admin/UsersDashboard";
import UserEdit from "../views/layout/Admin/UserEdit";
import CoursesDashboard from "../views/layout/Admin/CoursesDashboard";
import NewsDashboard from "../views/layout/Admin/NewsDashboard";

import Permissions from "../views/layout/Permissions";
import EditPermissions from "../views/layout/EditPermissions";
import Management from "../views/layout/Management";
import EditManagement from "../views/layout/EditManagement";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/user/dashboard",
        name: "UsersDashboard",
        component: UsersDashboard,
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
    {
        path: "/user/:id",
        name: "UserEdit",
        component: UserEdit,
    },
    {
        path: "/courses",
        name: "CoursesDashboard",
        component: CoursesDashboard,
    },
    {
        path: "/news",
        name: "NewsDashboard",
        component: NewsDashboard,
    },
    {
        path: "/user/management",
        name: "Management",
        component: Management,
    },
    {
        path: "/user/management/:id",
        name: "EditManagement",
        component: EditManagement,
    },
    {
        path: "/user/permissions",
        name: "Permissions",
        component: Permissions,
    },
    {
        path: "/user/permissions/:id",
        name: "EditPermissions",
        component: EditPermissions,
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL),
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("x-token");

    if (!token) {
        if (to.name === "Login" || to.name === "Registration") {
            return next();
        } else {
            return next({
                name: "Login",
            });
        }
    }
    if (to.name === "Login" || (to.name === "Registration" && token)) {
        return next({
            name: "Home",
        });
    }
    next();
});

export default router;
