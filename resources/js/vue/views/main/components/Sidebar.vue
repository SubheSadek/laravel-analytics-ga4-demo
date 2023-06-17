<template>

    <div v-if="route.children && route.children.length > 0"
        data-kt-menu-trigger="click" class="menu-item menu-accordion"
        :class="isCurrentRoute($route, route) && 'here hover show'">
		<span class="menu-link">
			<span class="menu-icon">
                <svg-icon :name="route.meta.iconName"></svg-icon>
			</span>
			<span class="menu-title">{{ route.meta.menuName }}</span>
			<span class="menu-arrow"></span>
		</span>
		<div class="menu-sub menu-sub-accordion menu-active-bg" :class="isCurrentRoute($route, route) && 'show'">
			<div  v-for="child in route.children" :key="child.path" class="menu-item" :class="child.meta.isHide ? 'd-none' : ''">
				<router-link
                    :to="route.path + '/' + child.path" class="menu-link"
                    :class=" ($route.name == child.name) || ($route.query.name && ($route.query.name == child.name))? 'active' : ''"
                >
					<span class="menu-bullet">
						<span class="bullet bullet-dot"></span>
					</span>
					<span class="menu-title">{{ child.meta.menuName }}</span>
				</router-link>
			</div>
		</div>
	</div>

    <div v-else class="menu-item" :class="($route.name === route.name) ? 'here show' : ''">
        <router-link :to="route.path" class="menu-link">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg-icon :name="route.meta.iconName"></svg-icon>
                </span>
            </span>
            <span class="menu-title">{{ route.meta.menuName }}</span>
        </router-link>
    </div>

</template>

<script setup>
import { useSideBar } from '../js/main';
const {
    isCurrentRoute
} = useSideBar();
defineProps(['route'])
</script>
