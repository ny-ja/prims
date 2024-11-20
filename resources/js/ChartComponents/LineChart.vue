<template>
    <Line :data="chartData" :options="chartOptions" />
  </template>
  
  <script setup lang="ts">
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineController,
    LineElement,
    PointElement,
    CategoryScale,
    LinearScale,
  } from 'chart.js';
  import { Line } from 'vue-chartjs';
  
  // Define Props
  const props = defineProps({
    data: {
      type: Object,
      required: true,
    },
    options: {
      type: Object,
      default: () => ({}),
    },
    title: {
      type: String,
      default: '',
    },
  });
  
  // Register Chart.js components
  ChartJS.register(
    CategoryScale,
    LinearScale,
    LineController,
    LineElement,
    PointElement,
    Title,
    Tooltip,
    Legend
  );
  
  // Prepare data and options for the Line chart
  const chartData = {
    labels: props.data.labels,
    datasets: props.data.datasets,
  };
  
  const chartOptions = {
    responsive: true,
    maintainAspectRatio: true, // For better resizing control
    plugins: {
      legend: {
        position: 'top' as const,
      },
      title: {
        display: true,
        text: props.title,
      },
    },
    ...props.options, // Merge with additional options passed as props
  };
  </script>
  