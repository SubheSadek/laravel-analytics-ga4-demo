<template>
    <div class="d-flex align-items-center">
        <div class="demo-upload-list">
            <template style="display: block;">
                <Image v-if="img" :src="`${addUrl(img)}`" fit="cover"
                    width="45" height="45" />
                <Image v-if="!img" :src="`${defaultImg}`" fit="cover" width="45"
                    height="45" />
                <div v-if="img" class="demo-upload-list-cover">
                    <Icon type="ios-eye-outline" @click="isPreview = true"></Icon>
                </div>
            </template>
        </div>
        <ImagePreview v-model="isPreview" :preview-list="[addUrl(img)]" />
    </div>
</template>

<script setup>
import {
    Image,
    Icon,
    ImagePreview
} from 'view-ui-plus';
import { ref } from 'vue';
import { addUrl, defaultImg } from '../services/global';
defineProps(['img']);
const isPreview = ref(false);
</script>

<style>

.demo-upload-list {
    top: -4px;
    display: inline-block;
    width: 55px;
    height: 55px;
    text-align: center;
    line-height: 60px;
    border-radius: 4px;
    overflow: hidden;
    background: #fff;
    position: relative;
    box-shadow: 0 1px 1px rgb(0 0 0 / 20%);
    margin-right: 4px;
}

.demo-upload-list img {
    width: 100%;
    height: 100%;
}

.demo-upload-list-cover {
    display: none;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, .6);
}

.demo-upload-list:hover .demo-upload-list-cover {
    display: block;
}

.demo-upload-list-cover i {
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    margin: 0 2px;
}
</style>
