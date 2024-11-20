<template>
    <PolarArea :data="chartData" :options="chartOptions" />
  </template>
  
  <script setup lang="ts">
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    PolarAreaController,
    RadialLinearScale,
    ArcElement,
  } from 'chart.js';
  import { PolarArea } from 'vue-chartjs';
  
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
    RadialLinearScale,
    ArcElement,
    PolarAreaController,
    Title,
    Tooltip,
    Legend
  );
  
  // Prepare data and options for the Polar Area chart
  const chartData = {
    labels: props.data.labels,
    datasets: props.data.datasets,
  };
  
  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false, // Allows resizing control
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
  