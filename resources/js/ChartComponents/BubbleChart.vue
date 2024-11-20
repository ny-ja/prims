<template>
    <Bubble :data="chartData" :options="chartOptions" />
  </template>
  
  <script setup lang="ts">
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BubbleController,
    PointElement,
    CategoryScale,
    LinearScale,
  } from 'chart.js';
  import { Bubble } from 'vue-chartjs';
  
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
    BubbleController,
    PointElement,
    Title,
    Tooltip,
    Legend
  );
  
  // Prepare data and options for the Bubble chart
  const chartData = {
    labels: props.data.labels,
    datasets: props.data.datasets,
  };
  
  const chartOptions = {
    responsive: true,
    maintainAspectRatio: true, // Allows better control of resizing
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
  