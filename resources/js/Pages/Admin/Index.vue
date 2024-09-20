<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import MainContentHeader from '@/Components/MainContentHeader.vue';

const props = defineProps(['residents', 'households', 'tenants', 'accommodations', 'householdsWithoutDependents', 'residentsWithTenancies', 'voters', 'nonVoters']);
</script>

<template>
    <AdminLayout title="Dashboard">
        <MainContentHeader>
            <template #title>
                Dashboard
            </template>
        </MainContentHeader>

        <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-4">
            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Residents</span>
                        <span class="text-lg font-semibold">{{ residents.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                    <span>from 2020</span>
                </div>
            </a>
            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Households</span>
                        <span class="text-lg font-semibold">{{ households.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                    <span>from 2020</span>
                </div>
            </a>
            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Tenants</span>
                        <span class="text-lg font-semibold">{{ tenants.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                    <span>from 2020</span>
                </div>
            </a>
            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Accommodations</span>
                        <span class="text-lg font-semibold">{{ accommodations.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                    <span>from 2020</span>
                </div>
            </a>
            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Households<br />Without Dependents</span>
                        <span class="text-lg font-semibold">{{ householdsWithoutDependents.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                    <span>from 2020</span>
                </div>
            </a>

            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of Residents With<br />Accommodation Tenancies</span>
                        <span class="text-lg font-semibold">{{ residentsWithTenancies.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="sessionsChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">1.2%</span>
                    <span>from 2020</span>
                </div>
            </a>

            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of<br />Registered Voters</span>
                        <span class="text-lg font-semibold">{{ voters.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="vistsChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">10%</span>
                    <span>from 2020</span>
                </div>
            </a>

            <a href="#"
                class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start">
                    <div class="flex flex-col flex-shrink-0 space-y-2">
                        <span class="text-gray-400">Number of<br />Non-Registered Voters</span>
                        <span class="text-lg font-semibold">{{ nonVoters.length }}</span>
                    </div>
                    <div class="relative min-w-0 ml-auto h-14">
                        <canvas id="articlesChart"></canvas>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">30%</span>
                    <span>from 2020</span>
                </div>
            </a>
        </div>
    </AdminLayout>
</template>