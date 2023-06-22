<template>
  <canvas id="userChart"></canvas>
</template>

<script setup>
import { onMounted } from 'vue';
import Chart from 'chart.js/auto';
import { CHART_COLORS, transparentize } from '../../../helpers/services/Utils'
const props = defineProps(['analyticsData']);
onMounted(() => {
  const ctx = document.getElementById('userChart');

    new Chart(ctx, {
    type: 'line',
        data: {
            labels: props.analyticsData.labels,
            datasets: [
                {
                    label: 'Total User',
                    data: props.analyticsData.data,
                    borderColor: CHART_COLORS.blue,
                    backgroundColor: transparentize(CHART_COLORS.blue, 0.5),
                },
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display:false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'User activity'
                }
            }
        },

    });
});
</script>
