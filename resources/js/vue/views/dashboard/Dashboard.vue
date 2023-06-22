<template>
    <UserChart style="width:100%;height: 200px;" v-if="!storeMain.dataLoading" :analyticsData="analyticsData"/>
</template>

<script setup>
import UserChart from './components/UserChart.vue';
import { useDashboard } from './js/dashboard'

const { storeMain, analyticsData, getStatistics } = useDashboard();
getStatistics();

</script>
