
import { callApi } from '../../../../helpers/services/callApi';
import { useMainStore } from '@/vue/store';

import { useSearch, toCapitalizeCase, confirmModal } from '../../../../helpers/services/global';
// import { ALL_USER_STATUS } from '../../../../helpers/services/utility';
import Utility from '../../../../helpers/services/utility';
import { defineAsyncComponent, reactive, ref } from 'vue';
import { formValidationFailedMsg } from '../../../../helpers/services/message'
import { lowerCase } from 'lodash';


export const useManageAdmin = () => {

    const storeMain = useMainStore();
    const { onSearch, onClear } = useSearch();
    let editData = ref(null);

    const CreateOrEditAdminModal = defineAsyncComponent(() =>
        import('../components/CreateOrEditAdminModal.vue')
    );

    const TableRow = defineAsyncComponent(() =>
        import('../../../../helpers/components/TableRow.vue')
    );

    const ImagePreviewModal = defineAsyncComponent(() =>
        import('../../../../helpers/components/ImagePreviewModal.vue')
    );

    const getAdmins = async () => {
        storeMain.setDataLoading(true);
        const res = await callApi('get', '/admin/manage/admin', storeMain.params, 'params');
        if (res.data.success) {
            storeMain.setDataToList(res.data.json_data);
        }
        setTimeout(() => {
            storeMain.setDataLoading(false);
        }, 200);
    }

    const openAddAdminModel = () => {
        editData.value = null;
        storeMain.isModal = true;
    }

    const openEditAdminModel = (admin, loader) => {
        admin[loader] = true;
        editData.value = admin;
        storeMain.isModal = true;
        admin[loader] = false;
    }

    const updateStatus = async (admin, status) => {

        const data = formatStatusUpdateData(admin.id, status);
        admin.isStatusChange = true;

        const res = await callApi('PUT', '/admin/manage/admin/update-status/'+ admin.id, data);
        if (res.data.success) { }

        setTimeout(() => {
            admin.isStatusChange = false;
        }, 200);

    }

    const formatStatusUpdateData = (adminId, status) => {
        return {
            'adminId': adminId,
            'status': status,
        }
    }

    const allAdminStatus = () => {
        return Utility.ALL_USER_STATUS.map((item) => {
            return {
                value: item,
                name: toCapitalizeCase(item),
                className: `_${lowerCase(item)}`
            }
        });
    }

    const deleteAdmin = (admin, isDeleting) => {

        confirmModal(
            'Are u sure to delete this admin?',
            async (onOk) => {

                admin[isDeleting] = true;
                const res = await callApi('DELETE', '/admin/manage/admin/delete/'+admin.id);
                if (res.data.success) {
                    getAdmins();
                }
                admin[isDeleting] = false;

            }
        )
    }

    return {
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
    }
}


export const useCreateOREditAdmin = (editData) => {

    const storeMain = useMainStore();

    const isLoading = ref(false);
    const formRef = ref(null);
    const roleList = reactive([]);

    const formData = reactive({
        role_id: null,
        name: null,
        email: null,
        phone: null,
        profile_pic: null,
        preview: null,
        password: null,
        password_confirmation: null,
    });


    const isPasswordRequired = () => {
        if (editData) {
            return false;
        }
        return true;
    }

    const ruleValidate = reactive({
        role_id: [
            { required: true, type:'number', message: 'Please select admin role', trigger: 'blur' },
        ],
        name: [
            { required: true, message: 'Please input name', trigger: 'blur' },
        ],
        phone: [
            { required: false, message: 'Please input phone number', trigger: 'blur' },
        ],
        email: [
            { required: true, message: 'Please input email', trigger: 'blur' },
            { type: 'email', message: 'Please input a valid email address', trigger: 'blur' },
        ],
        password: [
            { required: isPasswordRequired(), type:'string', message: 'Please input password', trigger: 'blur' },
            { min: 6, max: 255, message: 'Password must be between 6 and 255 characters', trigger: 'blur' },
        ],
        password_confirmation: [
            {
                validator: (rule, value, callback) => {
                    if (formData.password && value === '') {
                        callback(new Error('Please input password confirmation'));
                    } else if (formData.password && value !== formData.password) {
                        callback(new Error('Password confirmation is not same with password'));
                    } else {
                        callback();
                    }
                }, trigger: 'blur'
            },
        ]
    });


    const handleSubmit = () => {
        if (editData) {
            return updateAdmin(editData.id);
        }
        return createAdmin();
    }


    const createAdmin = () => {
        formRef.value.validate(async (valid) => {
            if (!valid) return formValidationFailedMsg();

            isLoading.value = true;

            const res = await callApi('POST', '/admin/manage/admin/store', formData);
            if (res.data.success) {

                storeMain.isModal = false;
                let data = res.data.json_data;
                storeMain.pushDataToList(data);

            }

            isLoading.value = false;

        })

    }


    const updateAdmin = (adminId) => {
        formRef.value.validate(async (valid) => {
            if (!valid) return formValidationFailedMsg();

            isLoading.value = true;

            const res = await callApi('PUT', '/admin/manage/admin/update/' + adminId, formData);
            if (res.data.success) {

                storeMain.isModal = false;
                let data = res.data.json_data;
                storeMain.replaceWithUpdatedData(data);

            }

            isLoading.value = false;

        })
    }


    const setEditData = () => {
        formData.role_id = editData.role_id;
        formData.name = editData.name;
        formData.email = editData.email;
        formData.phone = editData.phone;
        formData.profile_pic = editData.profile_pic;
        formData.preview = editData.preview
    }

    const getRoleList = async () => {
        storeMain.setDataLoading(true);
        const res = await callApi('get', '/admin/manage/role/role-list');
        if (res.data.success) {
            roleList.push(...res.data.json_data)
        }
        setTimeout(() => {
            storeMain.setDataLoading(false);
        }, 200);
    }

    return {
        storeMain,
        isLoading,
        formRef,
        formData,
        ruleValidate,
        handleSubmit,
        setEditData,
        roleList,
        getRoleList
    }
}
