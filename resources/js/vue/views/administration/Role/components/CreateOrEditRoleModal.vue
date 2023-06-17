<template>

    <Modal
        :styles="{top: '20px'}" v-model="storeMain.isModal"
        :loading="isLoading" width="700" footer-hide draggable
        class-name="vertical-center-modal" scrollable
        :title="(editData ? 'Edit' : 'Create') + ' Role'">

        <div class="modal-body pt-0">
            <Form @submit.prevent="handleSubmit" ref="formRef" :model="formData" :rules="ruleValidate" class="form w-100">

                <Row :gutter="16">

                    <Col span="24">
                        <div class="d-flex flex-column fv-row">
                            <FormItem class="form-label fs-6 fw-bolder text-dark" label="Role name" prop="name">
                                <Input size="large"
                                    v-model.trim="formData.name"
                                    type="text" placeholder="Role name"
                                    show-word-limit maxlength="255"
                                    autocomplete="off">
                                </Input>
                            </FormItem>
                        </div>
                    </Col>

                </Row>

                <div class="modal-button">

                    <Button
                        @click="handleSubmit()" size="large"
                        :loading="isLoading" :disabled="isLoading"
                        icon="md-add" type="primary">
                        {{ isLoading ? 'Please wait...' : 'Save Changes' }}
                    </Button>

                    <Button @click="storeMain.isModal = false;" size="large" type="default">Close</Button>
                </div>

            </Form>
        </div>
    </Modal>
</template>

<script setup>
import {
    Modal,
    Form,
    Row,
    Col,
    FormItem,
    Input,
    Button,
} from 'view-ui-plus';
const props  = defineProps(['editData']);
import { useCreateOREditRole } from '../js/role';

const {
    storeMain,
    isLoading,
    formRef,
    formData,
    ruleValidate,
    handleSubmit,
    setEditData
} = useCreateOREditRole(props.editData);

if (props.editData) {
    setEditData();
}
// import ProfilePic from './ProfilePic.vue'
</script>

