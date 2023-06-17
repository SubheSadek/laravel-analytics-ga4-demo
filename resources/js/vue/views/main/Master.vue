<template>
	<span>
		<div v-if="storeMain.dataLoading" id="loading">
			<img id="loading-image" src="@/assets/images/loader.gif"
				alt="Loading..." />
		</div>
		<div class="page_block"></div>
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
					data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
					data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
					data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Brand-->
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<!--begin::Logo-->
						<router-link to="/">
							<img alt="Logo" :src="`${baseUrl}assets/media/logos/logo-1-dark.svg`"
								class="h-25px logo" />
						</router-link>

						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
							data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
							data-kt-toggle-name="aside-minimize">

							<svg-icon name="collapse-arrow"></svg-icon>

						</div>

					</div>

					<div class="aside-menu flex-column-fluid">

                        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                                            <!--begin::Menu-->
                                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                                    <Sidebar
                                        :route="route"
                                        v-for="route in $router.options.routes"
                                        :key="route.path"
                                        :class=" isShowMenu(route) ? 'd-none' : ''"
                                    />

                                </div>
							<!--end::Menu-->
						</div>

					</div>

				</div>

				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                    <TopBar />

					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						<div class="post d-flex flex-column-fluid" id="kt_post">

							<div id="kt_content_container" class="container-xxl">

								<router-view></router-view>

							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->

				</div>
				<!--end::Wrapper-->
			</div>

		</div>

	</span>
</template>

<script setup>
import './css/main.css'

import { baseUrl } from '@/vue/helpers/services/global.js';
import { useMain } from './js/main';
const {
    Sidebar,
    TopBar,
    isShowMenu,
    useMainStore
} = useMain();
const storeMain = useMainStore();
</script>

