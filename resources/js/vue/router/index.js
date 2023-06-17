import { createRouter, createWebHistory } from "vue-router";
import AdminRoutes from "@/vue/views/administration/routes";
// const auth = window.authUser ? window.authUser : null;

const masterRoutes = [
    {
        path: "/",
        name: "dashboard",
        component: () => import("../views/dashboard/Dashboard.vue"),
        meta: {
            title: "Dashboard",
            menuName: "Dashboard",
            iconName: "homeIcon",
            isHide: false,
        },
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...masterRoutes,
        ...AdminRoutes
    ]
});

router.beforeEach((to, from, next) => {
    document.title =to.meta.title
    next();
});

export default router;
