<template>
    <div id="kt_header" class="header align-items-stretch" style="border-bottom: 1px solid rgb(239, 242, 245);">

        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                    id="kt_aside_mobile_toggle">
                    <svg-icon name="mobile-aside"></svg-icon>
                </div>
            </div>
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <a href="/" class="d-lg-none">
                    <img alt="Logo" :src="`${baseUrl}assets/media/logos/logo-2.svg`" class="h-30px" />
                </a>
            </div>
            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                <div class="d-flex align-items-stretch" id="kt_header_nav">
                    <div class="header-menu align-items-stretch" data-kt-drawer="true"
                        data-kt-drawer-name="header-menu"
                        data-kt-drawer-activate="{default: true, lg: false}"
                        data-kt-drawer-overlay="true"
                        data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                        data-kt-drawer-direction="end"
                        data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                        data-kt-swapper-mode="prepend"
                        data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                            id="#kt_header_menu" data-kt-menu="true">
                            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                class="menu-item here show menu-lg-down-accordion me-lg-1">
                                <h1	class="d-flex text-dark fw-bolder fs-3 align-items-center my-1 text-capitalize">
                                    {{ $route.meta.title ? $route.meta.title : '' }}
                                    <span class="h-20px border-1 border-gray-200 ms-3 mx-2 me-1"></span>
                                </h1>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="d-flex align-items-stretch flex-shrink-0">
                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                            data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                            data-kt-menu-placement="bottom-end">
                            <img :src="storeMain.authUser?.profile_pic || addUrl('assets/media/avatars/300-1.jpg')" alt="user" />
                        </div>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" :src="storeMain.authUser?.profile_pic || addUrl('assets/media/avatars/300-1.jpg')" />
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">
                                            {{ storeMain.authUser?.name }}
                                        </div>
                                        <a href="javascript:void(0)"
                                            class="fw-bold text-muted text-hover-primary fs-7 _disable_link">
                                            {{( storeMain.authUser?.email  || storeMain.authUser.phone)}}
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="menu-item px-5">
                                <router-link to="/admin/profile" class="menu-link px-5">Profile</router-link>
                            </div>
                            <div class="menu-item px-5">
                                <a @click="logout" href="javascript::void()" class="menu-link px-5">Sign
                                    Out</a>
                            </div>
                            <div class="separator my-2"></div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center d-lg-none ms-2 me-n3"
                        title="Show header menu">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                            id="kt_header_menu_mobile_toggle">
                            <svg-icon name="mobile-toggle"></svg-icon>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</template>

<script setup>
import { baseUrl, addUrl } from "@/vue/helpers/services/global";
import { useMain } from "../js/main";
const { logout, useMainStore } = useMain();
const storeMain = useMainStore();
</script>
