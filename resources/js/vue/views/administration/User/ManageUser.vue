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
                        type="text" @on-search="onSearch(getUsers)"
                        search enter-button="Search"
                        @on-change="onClear(getUsers)"
                        placeholder="Search by name, phone and email.." />
                </div>

                <!-- <div class="position-relative w-md-100px me-md-2">
                    <SelectStaticOption v-model:formValue="storeMain.params.status" v-model:initialData="types"
                        :title="`Status`" @onChange="searchMethod" />
                </div> -->

            </div>

            <div class="card-toolbar">

                <a @click="openAddUserModel()" href="javascript:void(0)" class="btn btn-sm btn-light-primary">
                    <svg-icon name="plus"></svg-icon>
                    New User
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
                                <th class="min-w-50px">Status</th>
                                <th class="min-w-100px"></th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr v-for="(user) in storeMain.getDataList.data" :key="(user.id)">

                                <td>
                                    <ImagePreviewModal :img="user.profile_pic"/>
                                </td>

                                <td>
                                    <TableRow :value="user.name" />
                                </td>

                                <td>
                                    <TableRow :value="user.phone" />
                                </td>

                                <td>
                                    <TableRow :value="user.email" />
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">

                                        <div :class="Boolean(user.isStatusChange) && 'd-none'" class="d-flex justify-content-start flex-column">
                                            <Select @on-change="value => updateStatus(user, value)" v-model="user.status"
                                                size="small" :disabled="user.isLoading"
                                                :class="`_${user.status.toLowerCase()}`"
                                                style="width:100px">
                                                <Option
                                                    v-for="status in allUserStatus()"
                                                    :key="status.value"
                                                    :value="status.value">
                                                    <span :class="status.className">{{ status.name }}</span>
                                                </Option>
                                            </Select>
                                        </div>

                                        <div v-if="user.isStatusChange" class="d-inline">
                                            <Icon type="ios-loading" class="ivu-anim-loop" size="24" /> Please wait...
                                        </div>

                                    </div>
                                </td>

                                <td class="text-end">
                                    <Tooltip :content="user.isEditing ? 'Please wait...' : 'Edit User'" placement="top-end">
                                        <a
                                            @click="openEditUserModel(user, 'isEditing')"
                                            :class="user.isEditing && 'disabled'"
                                            href="javascript:void(0)"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        >
                                            <svg-icon :name="user.isEditing ? 'loading' : 'edit'"></svg-icon>
                                        </a>
                                    </Tooltip>

                                    <Tooltip :content="user.isDeleting ? 'Please wait...' : 'Delete User'" placement="top-end">
                                        <a
                                            @click="deleteUser(user, 'isDeleting')"
                                            href="javascript:void(0)"
                                            :class="user.isDeleting && 'disabled'"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                        >
                                            <svg-icon :name="user.isDeleting ? 'loading' : 'delete'"></svg-icon>
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
        @on-page-size-change="e => (storeMain.params.pageSize = e, getUsers())"
        v-model="storeMain.params.page"
        @on-change="getUsers" :total="storeMain.getDataList.meta.total"
        show-sizer style="text-align:center;"
    />

    <CreateOrEditUserModal
        v-if="storeMain.isModal"
        :edit-data="editData"
        :is-read-only="isReadonly"
     />

</template>

<script setup>
import './css/user.css';
import {
    Select,
    Option,
    Input,
    Button,
    Page,
    Icon,
    Tooltip
} from 'view-ui-plus';

import { useManageUser } from './js/user';
const {
    editData,
    CreateOrEditUserModal,
    TableRow,
    ImagePreviewModal,
    isReadonly,
    getUsers,
    openAddUserModel,
    openEditUserModel,
    storeMain,
    onSearch,
    onClear,
    updateStatus,
    allUserStatus,
    deleteUser
} = useManageUser();

//Call function on page load
getUsers();


</script>


