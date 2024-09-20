<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import LinkIcon from '@/Components/LinkIcon.vue';
import Icon from '@/Components/Icon.vue';

const props = defineProps(['household', 'dependents']);

</script>


<template>
    <AdminLayout title="Household Dependents">
        <MainContentHeader>
            <template #title>
                Household dependent(s)
            </template>
            <template #buttons>
                <LinkIcon :href="route('admin.households.index')">
                    <template #icon>
                        <Icon name="back" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Back</template>
                </LinkIcon>
            </template>
        </MainContentHeader>
        <div v-if="dependents.length == 0"
            class="text-center mt-6 text-xs font-medium tracking-wider text-gray-500 uppercase">
            No dependents</div>
        <div v-else class="flex flex-col mt-6">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                        <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Birthdate</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Relationship to Head</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="dependent in dependents" :key="dependent.id"
                                    class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ dependent.first_name }} {{
                                            dependent.middle_name }} {{
                                                dependent.family_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ dependent.birthday }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ dependent.relationship_to_head }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <Link :href="route('admin.dependents.show', dependent)"
                                            class="text-green-600 hover:text-teal-900">
                                        more info</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
