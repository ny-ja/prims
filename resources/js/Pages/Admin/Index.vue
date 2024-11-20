<script setup>
import { ref, computed, onMounted } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import MainContentHeader from '@/Components/MainContentHeader.vue';
import Chart from '@/Components/Chart.vue';
import TableContainer from '@/Components/TableContainer.vue';

const props = defineProps(['residents', 'households', 'tenants', 'establishments', 'ageDistribution', 'civilStatusDistribution', 'votersRegistrationStatusDistribution', 'sexDistribution', 'employmentStatusDistribution', 'employmentSectorDistribution']);

const currentDate = ref('');
onMounted(() => {
    const today = new Date();
    currentDate.value = today.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
});

const sexLabels = computed(() => Object.keys(props.sexDistribution));
const sexValues = computed(() => Object.values(props.sexDistribution));

const ageLabels = computed(() => Object.keys(props.ageDistribution));
const ageValues = computed(() => Object.values(props.ageDistribution));

const civilStatusLabels = computed(() => Object.keys(props.civilStatusDistribution));
const civilStatusValues = computed(() => Object.values(props.civilStatusDistribution));

const votersStatusLabels = computed(() => Object.keys(props.votersRegistrationStatusDistribution));
const votersStatusValues = computed(() => Object.values(props.votersRegistrationStatusDistribution));

const employmentStatusLabels = computed(() => Object.keys(props.employmentStatusDistribution));
const employmentStatusValues = computed(() => Object.values(props.employmentStatusDistribution));

const employmentSectorLabels = computed(() => Object.keys(props.employmentSectorDistribution));
const employmentSectorValues = computed(() => Object.values(props.employmentSectorDistribution));

</script>

<template>
    <AdminLayout title="Dashboard">
        <MainContentHeader>
            <template #title>
                Dashboard
            </template>
        </MainContentHeader>

        <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Users chart card --><a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Total Residents</span>
                        <span class="text-lg font-semibold">{{ residents.length }}</span>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-teal-800 rounded">{{ currentDate }}</span>
                </div>
            </a>

            <!-- Sessions chart card --><a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Total Households</span>
                        <span class="text-lg font-semibold">{{ households.length }}</span>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-teal-800 rounded">{{ currentDate }}</span>
                </div>
            </a>

            <!-- Vists chart card --><a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Total Tenants</span>
                        <span class="text-lg font-semibold">{{ tenants.length }}</span>
                    </div>
                </div>
                <div><span class="inline-block px-2 text-sm text-white bg-teal-800 rounded">{{ currentDate }}</span>
                </div>
            </a>

            <!-- Articles chart card --><a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Total Establishments</span>
                        <span class="text-lg font-semibold">{{ establishments.length }}</span>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-teal-800 rounded">{{ currentDate }}</span>
                </div>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row border p-4 rounded-lg shadow-lg mt-6">
            <div class="w-1/30">
                <Chart :labels="sexLabels" :data="sexValues" :chartTitle="'Sex Distribution'"
                    :backgroundColor="['#4A90E2', '#FF6F91']" :chartType="'Doughnut'" />
            </div>
            <div class="w-2/3">
                <Chart :labels="ageLabels" :data="ageValues" :chartTitle="'Age Distribution'"
                    :backgroundColor="['#A8E6CF', '#FFD54F', '#FF8A65', '#B0BEC5']" :chartType="'Bar'" />
                <Chart :labels="civilStatusLabels" :data="civilStatusValues" :chartTitle="'Civil Status Distribution'"
                    :backgroundColor="['#EF5350', '#42A5F5', '#BDBDBD', '#AB47BC', '#66BB6A', '#FFA726']"
                    :chartType="'Bar'" />
            </div>

        </div>
        <div class="flex flex-col lg:flex-row border p-4 rounded-lg shadow-lg mt-6">
            <div class="w-1/30">
                <Chart :labels="votersStatusLabels" :data="votersStatusValues"
                    :chartTitle="'Voters Registration Status Distribution'" :backgroundColor="['#EF5350', '#66BB6A']"
                    :chartType="'Pie'" />
            </div>
            <div class="w-2/3">
                <Chart :labels="employmentStatusLabels" :data="employmentStatusValues"
                    :chartTitle="'Employment Status Distribution'" :backgroundColor="['#115e59']" :chartType="'Line'" />
                <Chart :labels="employmentSectorLabels" :data="employmentSectorValues"
                    :chartTitle="'Employment Sector Distribution'" :backgroundColor="['#115e59']" :chartType="'Line'" />
            </div>

        </div>
    </AdminLayout>
</template>