<script setup>
import BarChart from '@/ChartComponents/BarChart.vue';
import PieChart from '@/ChartComponents/PieChart.vue';
import DoughnutChart from '@/ChartComponents/DoughnutChart.vue';
import LineChart from '@/ChartComponents/LineChart.vue';
import BubbleChart from '@/ChartComponents/BubbleChart.vue';
import PolarAreaChart from '@/ChartComponents/PolarAreaChart.vue';
import RadarChart from '@/ChartComponents/RadarChart.vue';

const props = defineProps({
    chartTitle: String,
    labels: Array,
    data: Array,
    backgroundColor: Array,
    chartType: String,
});

const chartData = {
    labels: props.labels,
    datasets: [
        {
            data: props.data,
            backgroundColor: props.backgroundColor,
        }
    ]
}

const chartOptions = {
    // Add any additional options if needed
}

const chartTitle = props.chartTitle;
</script>

<template>
    <div v-if="chartType === 'Bar'">
        <BarChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'Pie'">
        <PieChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'Doughnut'">
        <DoughnutChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'Line'">
        <LineChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'Bubble'">
        <BubbleChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'PolarArea'">
        <PolarAreaChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'Radar'">
        <RadarChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>

</template>