import { defineAsyncComponent } from "vue";
import { callApi } from "../../../helpers/services/callApi";
import { useMainStore } from '@/vue/store';
export const useMain = () => {

    const Sidebar = defineAsyncComponent(() =>
        import('../components/Sidebar.vue')
    );

    const TopBar = defineAsyncComponent(() =>
        import('../components/TopBar.vue')
    );

    const logout = async () => {
		let res = await callApi('get', '/admin/auth/logout');
		if (res.data.success) {
			window.location.reload();
		}
    }

    const isShowMenu = (route) => {
    	return route.meta.isHide;
    }

    return {
        Sidebar,
        TopBar,
        logout,
        isShowMenu,
        useMainStore
    }
}

export const useSideBar = () => {
    const isCurrentRoute = (currentRoute, route) => {
        return currentRoute.meta.parent == route.name;
    }

    return {
        isCurrentRoute
    }
}
