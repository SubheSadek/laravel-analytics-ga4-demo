<template>
  <canvas id="myChart"></canvas>
</template>

<script setup>
import { onMounted } from 'vue';
import Chart from 'chart.js/auto';
import {months, CHART_COLORS, transparentize} from '../../../helpers/services/Utils'
onMounted(() => {
  const ctx = document.getElementById('myChart');
  const labels = months({ count: 56 });
  const DATA_COUNT = 7;
    const NUMBER_CFG = { count: DATA_COUNT, min: -100, max: 100 };

  if (ctx) {
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [
            {
                label: 'Dataset 1',
                data: [70, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40],
                borderColor: CHART_COLORS.blue,
                backgroundColor: transparentize(CHART_COLORS.blue, 0.5),
            },
        ]
      },

    options: {
        responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Chart.js Line Chart'
        }
        }
    },

    });
  }
});
</script>
