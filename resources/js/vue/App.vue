<template>
    <Master v-if="storMain.authUser"/>
    <SignIn v-else/>
</template>

<script setup>
import Master from '@/vue/views/main/Master.vue'
import SignIn from '@/vue/views/auth/SignIn.vue'
import { useMainStore } from './store';
const storMain = useMainStore();
</script>
