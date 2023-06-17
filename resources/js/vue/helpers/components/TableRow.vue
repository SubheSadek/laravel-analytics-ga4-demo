<template>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-start flex-column">
            <a
                href="javascript:void(0)"
                class="text-dark _disable_link text-hover-primary mb-1 fs-6">
                {{ value || 'N/A' }}
            </a>
        </div>
    </div>
</template>

<script setup>
defineProps(['value']);
</script>
