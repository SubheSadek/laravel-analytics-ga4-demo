

const adminRoutes = [
    {
        path: "/administration",
        name: "administration",
        meta: {
            title: "Administration",
            menuName: "Administration",
            iconName: "administration",
        },
        children: [
            {
                path: "manage-roles",
                name: "manageRoles",
                component: () => import("./Role/ManageRole.vue"),
                meta: {
                    title: "Manage Roles",
                    menuName: "Manage role",
                    iconName: "homeIcon",
                    parent: "administration",
                },
            },
            {
                path: "manage-users",
                name: "manageUsers",
                component: () => import("./User/ManageUser.vue"),
                meta: {
                    title: "Manage Users",
                    menuName: "Manage user",
                    iconName: "homeIcon",
                    parent: "administration",
                },
            },
            {
                path: "manage-admins",
                name: "manageAdmins",
                component: () => import("./Admin/ManageAdmin.vue"),
                meta: {
                    title: "Manage Admin Users",
                    menuName: "Manage Admin",
                    iconName: "homeIcon",
                    parent: "administration",
                },
            },
        ],
    },

];


export default adminRoutes;
