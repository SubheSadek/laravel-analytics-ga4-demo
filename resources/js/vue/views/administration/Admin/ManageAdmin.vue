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
                        type="text" @on-search="onSearch(getAdmins)"
                        search enter-button="Search"
                        @on-change="onClear(getAdmins)"
                        placeholder="Search by name, phone and email.." />
                </div>

                <!-- <div class="position-relative w-md-100px me-md-2">
                    <SelectStaticOption v-model:formValue="storeMain.params.status" v-model:initialData="types"
                        :title="`Status`" @onChange="searchMethod" />
                </div> -->

            </div>

            <div class="card-toolbar">

                <a @click="openAddAdminModel()" href="javascript:void(0)" class="btn btn-sm btn-light-primary">
                    <svg-icon name="plus"></svg-icon>
                    New Admin
                </a>

            </div>
        </div>

        <div class="card-body py-3">

            <div class="table-responsive">

                <Transition>

                    <table v-if="!storeMain.dataLoading" class="table table-striped align-middle gs-0 gy-4">

                        <thead>

                            <tr class="fw-bolder text-white bg-primary">
                                <th class="ps-4 min-w-50px"></th>
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-80px">Phone</th>
                                <th class="min-w-100px">Email</th>
                                <th class="min-w-100px">Role</th>
                                <th class="min-w-50px">Status</th>
                                <th class="min-w-100px"></th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr v-for="(admin) in storeMain.getDataList.data" :key="(admin.id)">

                                <td>
                                    <ImagePreviewModal :img="admin.profile_pic"/>
                                </td>

                                <td>
                                    <TableRow :value="admin.name" />
                                </td>

                                <td>
                                    <TableRow :value="admin.phone" />
                                </td>

                                <td>
                                    <TableRow :value="admin.email" />
                                </td>

                                <td>
                                    <TableRow :value="admin.role?.name" />
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">

                                        <div :class="Boolean(admin.isStatusChange) && 'd-none'" class="d-flex justify-content-start flex-column">
                                            <Select @on-change="value => updateStatus(admin, value)" v-model="admin.status"
                                                size="small" :disabled="admin.isLoading"
                                                :class="`_${admin.status.toLowerCase()}`"
                                                style="width:100px">
                                                <Option
                                                    v-for="status in allAdminStatus()"
                                                    :key="status.value"
                                                    :value="status.value">
                                                    <span :class="status.className">{{ status.name }}</span>
                                                </Option>
                                            </Select>
                                        </div>

                                        <div v-if="admin.isStatusChange" class="d-inline">
                                            <Icon type="ios-loading" class="ivu-anim-loop" size="24" /> Please wait...
                                        </div>

                                    </div>
                                </td>

                                <td class="text-end">
                                    <Tooltip :content="admin.isEditing ? 'Please wait...' : 'Edit Admin'" placement="top-end">
                                        <a
                                            @click="openEditAdminModel(admin, 'isEditing')"
                                            :class="admin.isEditing && 'disabled'"
                                            href="javascript:void(0)"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        >
                                            <svg-icon :name="admin.isEditing ? 'loading' : 'edit'"></svg-icon>
                                        </a>
                                    </Tooltip>

                                    <Tooltip :content="admin.isDeleting ? 'Please wait...' : 'Delete Admin'" placement="top-end">
                                        <a
                                            @click="deleteAdmin(admin, 'isDeleting')"
                                            href="javascript:void(0)"
                                            :class="admin.isDeleting && 'disabled'"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                        >
                                            <svg-icon :name="admin.isDeleting ? 'loading' : 'delete'"></svg-icon>
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
        @on-page-size-change="e => (storeMain.params.pageSize = e, getAdmins())"
        v-model="storeMain.params.page"
        @on-change="getAdmins" :total="storeMain.getDataList.meta.total"
        show-sizer style="text-align:center;"
    />

    <CreateOrEditAdminModal
        v-if="storeMain.isModal"
        :edit-data="editData"
     />

</template>

<script setup>
import './css/admin.css';
import {
    Select,
    Option,
    Input,
    Button,
    Page,
    Icon,
    Tooltip
} from 'view-ui-plus';


import { useManageAdmin } from './js/admin';
const {
    editData,
    CreateOrEditAdminModal,
    TableRow,
    ImagePreviewModal,
    getAdmins,
    openAddAdminModel,
    openEditAdminModel,
    storeMain,
    onSearch,
    onClear,
    updateStatus,
    allAdminStatus,
    deleteAdmin
} = useManageAdmin();

//Call function on page load
getAdmins();


</script>


