<template>
  <Bar :data="data" :options="options" />
</template>

<script setup lang="ts">
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js';
import { Bar } from 'vue-chartjs';

const props = defineProps({
  data: {
    type: Object,
    required: true
  },
  options: {
    type: Object,
    default: () => ({})
  },
  title: {
    type: String,
    default: ''
  }
});

// Register Chart.js components
ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)

// Set data and options based on props
const data = {
  labels: props.data.labels,
  datasets: props.data.datasets
}

const options = {
  responsive: true,
  maintainAspectRatio: true, // Allows better control of resizing
  plugins: {
    legend: {
      position: 'top' as const
    },
    title: {
      display: true,
      text: props.title
    }
  },
  ...props.options, // Merge with additional options passed as props
};
</script>