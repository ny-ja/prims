<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import MainContentHeader from '@/Components/MainContentHeader.vue';
import Chart from '@/Components/Chart.vue';

const props = defineProps(['residents', 'households', 'tenants', 'accommodations', 'householdsWithoutDependents', 'residentsWithTenancies', 'voters', 'nonVoters']);

</script>

<template>
    <AdminLayout title="Dashboard">
        <MainContentHeader>
            <template #title>
                Dashboard
            </template>
        </MainContentHeader>

        <div class="w-1/3 h-auto">
            <Chart :labels="['Voters', 'Non-voters']" :data="[props.voters.length, props.nonVoters.length]"
                :chartTitle="'Voters status'" :backgroundColor="['#FF6384', '#36A2EB']" :chartType="'Doughnut'" />
        </div>


        <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-4">
            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Residents</span>
                        <span class="text-lg font-semibold">{{ residents.length }}</span>
                    </div>
                </div>
            </a>
            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Households</span>
                        <span class="text-lg font-semibold">{{ households.length }}</span>
                    </div>
                </div>
            </a>
            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Tenants</span>
                        <span class="text-lg font-semibold">{{ tenants.length }}</span>
                    </div>
                </div>
            </a>
            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Accommodations</span>
                        <span class="text-lg font-semibold">{{ accommodations.length }}</span>
                    </div>
                </div>
            </a>
            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Households<br />Without Dependents</span>
                        <span class="text-lg font-semibold">{{ householdsWithoutDependents.length }}</span>
                    </div>
                </div>
            </a>

            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Residents With<br />Accommodation Tenancies</span>
                        <span class="text-lg font-semibold">{{ residentsWithTenancies.length }}</span>
                    </div>
                </div>
            </a>

            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of<br />Registered Voters</span>
                        <span class="text-lg font-semibold">{{ voters.length }}</span>
                    </div>
                </div>
            </a>

            <a href="#" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of<br />Non-Registered Voters</span>
                        <span class="text-lg font-semibold">{{ nonVoters.length }}</span>
                    </div>
                </div>
            </a>
        </div>
    </AdminLayout>
</template>