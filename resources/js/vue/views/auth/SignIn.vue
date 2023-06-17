<template>
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">

            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px position-xl-relative">

                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">

                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">

                        <a href="/" class="py-9 mb-5">
                            <img alt="Logo" :src="baseUrl + ('assets/media/logos/logo-2.svg')" class="h-60px" />
                        </a>

                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to SAMC</h1>
                    </div>

                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        :style="`background-image: url(${baseUrl}assets/media/illustrations/sketchy-1/13.png)`">
                    </div>

                </div>

            </div>

            <div class="d-flex flex-column flex-lg-row-fluid py-10">

                <div class="d-flex flex-center flex-column flex-column-fluid">

                    <div class="w-lg-500px p-10 p-lg-15 mx-auto" style="margin-top:10% !important;">

                        <Form ref="signInFormRef" :model="formValidate" :rules="ruleValidate" class="form w-100">

                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">Sign In to Admin Boilerplate</h1>
                            </div>

                            <div class="fv-row mb-10">

                                <FormItem class="form-label fs-6 fw-bolder text-dark" label="Email" prop="email">
                                    <Input
                                        class="custom_inp_login"
                                        @on-enter="signIn('formValidate')"
                                        v-model="formValidate.email"
                                        type="text" placeholder="Email"
                                        autocomplete="off">
                                    </Input>
                                </FormItem>

                            </div>

                            <div class="fv-row mb-10">
                                <FormItem class="form-label fw-bolder text-dark fs-6 mb-0" label="Password" prop="password">

                                    <Input
                                        class="custom_inp_login"
                                        @on-enter="signIn('formValidate')"
                                        v-model="formValidate.password"
                                        type="password" password
                                        placeholder="Password" autocomplete="off">
                                    </Input>

                                </FormItem>
                            </div>

                            <div class="text-center">

                                <Button
                                    :loading="isLoading" shape="circle"
                                    style="height: 51px;" :disabled="isLoading"
                                    @click="signIn('formValidate')" size="large"
                                    type="primary" long>

                                    {{ isLoading ? 'Please wait ...' : 'Continue' }}

                                </Button>

                            </div>

                        </Form>

                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script setup>

import {
    Form,
    FormItem,
    Input,
    Button
} from 'view-ui-plus'

import { useSignIn } from './js/signIn';
import { baseUrl } from '../../helpers/services/global';
const {
    formValidate,
    ruleValidate,
    signInFormRef,
    signIn,
    isLoading
} = useSignIn();


</script>

