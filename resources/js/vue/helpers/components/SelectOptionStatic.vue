<template>
    <Select class="custom_inp" :model-value="formValue" clearable @on-change="handleChange" size="large" :placeholder="`${title}`">
        <Option v-if="initialData.length > 0 ? false : true" :value="`${title}`" disabled>
            {{ title }}
        </Option>
        <Option v-for="item in initialData" :value="item.value" :label="item.name" :key="item.value"></Option>
    </Select>
</template>

<script setup>
import {
    Select,
    Option,
} from 'view-ui-plus';
defineProps(['formValue', 'initialData', 'title', 'onChange'])
const emit = defineEmits(['update:formValue', 'onChange'])
const handleChange = (value) => {
    emit('update:formValue', (value ?? null))
    emit('onChange', (value ?? null))
}
</script>
