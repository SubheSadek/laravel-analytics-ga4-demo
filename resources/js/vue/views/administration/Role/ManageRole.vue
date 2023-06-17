<template>
    <div class="card _box_shadow mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label  fs-3 mb-1">{{ $route.meta.title }} Table</span>
                <span class="text-muted mt-1 fw-bold fs-7">Total Records : {{ storeMain.getDataList.meta?.total }}</span>
            </h3>

            <div class="d-flex align-items-center">

                <div class="position-relative w-md-300px me-md-2">
                    <Input v-model.trim="storeMain.params.searchTxt"
                        type="text" @on-search="onSearch(getRoles)"
                        search enter-button="Search"
                        @on-change="onClear(getRoles)"
                        placeholder="Search by role name" />
                </div>

            </div>

            <div class="card-toolbar">

                <a @click="openAddRoleModel()" href="javascript:void(0)" class="btn btn-sm btn-light-primary">
                    <svg-icon name="plus"></svg-icon>
                    New Role
                </a>

            </div>
        </div>

        <div class="card-body py-3">

            <div class="table-responsive">

                <Transition>

                    <table v-if="!storeMain.dataLoading" class="table table-striped align-middle gs-0 gy-4">

                        <thead>

                            <tr class="fw-bolder text-white bg-primary">
                                <th class="ps-4 min-w-100px">SL.</th>
                                <th class="min-w-200px">Name</th>
                                <th class="min-w-100px"></th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr v-for="(role, index) in storeMain.getDataList.data" :key="(role.id)">
                                <td>
                                    <TableRow :value="(storeMain.getDataList.from + index)" />
                                </td>
                                <td>
                                    <TableRow :value="role.name" />
                                </td>

                                <td class="text-end">
                                    <Tooltip :content="role.isEditing ? 'Please wait...' : 'Edit Role'" placement="top-end">
                                        <a
                                            @click="openEditRoleModel(role, 'isEditing')"
                                            :class="role.isEditing && 'disabled'"
                                            href="javascript:void(0)"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        >
                                            <svg-icon :name="role.isEditing ? 'loading' : 'edit'"></svg-icon>
                                        </a>
                                    </Tooltip>

                                    <Tooltip :content="role.isDeleting ? 'Please wait...' : 'Delete Role'" placement="top-end">
                                        <a
                                            @click="deleteRole(role, 'isDeleting')"
                                            href="javascript:void(0)"
                                            :class="role.isDeleting && 'disabled'"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                        >
                                            <svg-icon :name="role.isDeleting ? 'loading' : 'delete'"></svg-icon>
                                        </a>
                                    </Tooltip>

                                </td>

                            </tr>

                        </tbody>
                    </table>
                </Transition>

                <div v-if="!storeMain.getDataList.meta?.total" class="no_data">
                    <h2>No Data Available</h2>
                </div>

            </div>
        </div>
    </div>

    <Page
        v-if="storeMain.getDataList.meta?.total"
        @on-page-size-change="e => (storeMain.params.pageSize = e, getRoles())"
        v-model="storeMain.params.page"
        @on-change="getRoles" :total="storeMain.getDataList.meta.total"
        show-sizer style="text-align:center;"
    />

    <CreateOrEditRoleModal
        v-if="storeMain.isModal"
        :edit-data="editData"
     />

</template>

<script setup>
import './css/role.css';
import {
    Select,
    Option,
    Input,
    Button,
    Page,
    Icon,
    Tooltip
} from 'view-ui-plus';

import { useManageRole } from './js/role';
const {
    CreateOrEditRoleModal,
    TableRow,
    editData,
    isReadonly,
    getRoles,
    openAddRoleModel,
    openEditRoleModel,
    storeMain,
    onSearch,
    onClear,
    updateStatus,
    allRoleStatus,
    deleteRole
} = useManageRole();

//Call function on page load
getRoles();


</script>


