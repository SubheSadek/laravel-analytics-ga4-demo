
import { callApi } from '../../../../helpers/services/callApi';
import { useMainStore } from '@/vue/store';

import { useSearch, confirmModal } from '../../../../helpers/services/global';

import { defineAsyncComponent, reactive, ref } from 'vue';
import { formValidationFailedMsg } from '../../../../helpers/services/message'

export const useManageRole = () => {

    const storeMain = useMainStore();
    const { onSearch, onClear } = useSearch();

    const CreateOrEditRoleModal = defineAsyncComponent(() =>
        import('../components/CreateOrEditRoleModal.vue')
    );
    const TableRow = defineAsyncComponent(() =>
        import('../../../../helpers/components/TableRow.vue')
    );

    let editData = ref(null);

    const getRoles = async () => {
        storeMain.setDataLoading(true);
        const res = await callApi('get', '/admin/manage/role', storeMain.params, 'params');
        if (res.data.success) {
            storeMain.setDataToList(res.data.json_data);
        }
        setTimeout(() => {
            storeMain.setDataLoading(false);
        }, 200);
    }

    const openAddRoleModel = () => {
        editData.value = null;
        storeMain.isModal = true;
    }

    const openEditRoleModel = (role, isOpenModal) => {
        role[isOpenModal] = true;
        editData.value = role;
        storeMain.isModal = true;
        role[isOpenModal] = false;
    }

    const deleteRole = (role, isDeleting) => {

        confirmModal(
            'Are u sure to delete this role?',
            async (onOk) => {

                role[isDeleting] = true;
                const res = await callApi('DELETE', '/admin/manage/role/delete/'+role.id);
                if (res.data.success) {
                    getRoles();
                }
                role[isDeleting] = false;

            }
        )
    }

    return {
        CreateOrEditRoleModal,
        TableRow,
        editData,
        getRoles,
        openAddRoleModel,
        openEditRoleModel,
        storeMain,
        onSearch,
        onClear,
        deleteRole
    }
}


export const useCreateOREditRole = (editData) => {

    const storeMain = useMainStore();

    const isLoading = ref(false);
    const formRef = ref(null);

    const formData = reactive({
        name: null,
    });


    const ruleValidate = reactive({
        name: [
            { required: true, type:'string', message: 'Please input role name', trigger: 'blur' },
        ]
    });


    const handleSubmit = () => {
        if (editData) {
            return updateRole(editData.id);
        }
        return createRole();
    }


    const createRole = () => {
        formRef.value.validate(async (valid) => {
            if (!valid) return formValidationFailedMsg();

            isLoading.value = true;

            const res = await callApi('POST', '/admin/manage/role/store', formData);
            if (res.data.success) {

                storeMain.isModal = false;
                let data = res.data.json_data;
                storeMain.pushDataToList(data);

            }

            isLoading.value = false;

        })

    }


    const updateRole = (roleId) => {
        formRef.value.validate(async (valid) => {
            if (!valid) return formValidationFailedMsg();

            isLoading.value = true;

            const res = await callApi('PUT', '/admin/manage/role/update/' + roleId, formData);
            if (res.data.success) {

                storeMain.isModal = false;
                let data = res.data.json_data;
                storeMain.replaceWithUpdatedData(data);

            }

            isLoading.value = false;

        })
    }


    const setEditData = () => {
        formData.name = editData.name;
    }

    return {
        storeMain,
        isLoading,
        formRef,
        formData,
        ruleValidate,
        handleSubmit,
        setEditData
    }
}
