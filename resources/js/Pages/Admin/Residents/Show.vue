<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import ShowInformationContainer from '@/Components/ShowInformationContainer.vue';
import LinkIcon from '@/Components/LinkIcon.vue';
import Icon from '@/Components/Icon.vue';

const props = defineProps(['resident']);

</script>


<template>
    <AdminLayout title="Resident Information">
        <MainContentHeader>
            <template #title>
                {{ resident.first_name }} {{ resident.middle_name }} {{ resident.family_name }} Information
            </template>
            <template #buttons>
                <LinkIcon :href="route('admin.residents.index')">
                    <template #icon>
                        <Icon name="back" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Back</template>
                </LinkIcon>
            </template>
        </MainContentHeader>

        <ShowInformationContainer>
            <template #content>
                <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{ resident.first_name }} {{
                        resident.middle_name }} {{ resident.family_name }}</h1>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Contact Number</span>
                        <span class="ml-auto text-gray-900">{{ resident.contact_number }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Email</span>
                        <span class="ml-auto text-gray-900">{{ resident.email }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Birthday</span>
                        <span class="ml-auto text-gray-900">{{ resident.birthday }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Birthplace</span>
                        <span class="ml-auto text-gray-900">{{ resident.birthplace }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Blood Type</span>
                        <span class="ml-auto text-gray-900">{{ resident.blood_type }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Sex</span>
                        <span class="ml-auto text-gray-900">{{ resident.sex }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Street Address</span>
                        <span class="ml-auto text-gray-900">{{ resident.street_address }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Employment Status</span>
                        <span class="ml-auto text-gray-900">{{ resident.employment_status }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Employment Sector</span>
                        <span class="ml-auto text-gray-900">{{ resident.employment_sector }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Educational Attainment</span>
                        <span class="ml-auto text-gray-900">{{ resident.educational_attainment }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Course</span>
                        <span class="ml-auto text-gray-900">{{ resident.course }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Social Classification</span>
                        <span class="ml-auto text-gray-900">{{ resident.social_classification.join(', ') }}</span>
                    </div>

                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Voter Status</span>
                        <span class="ml-auto text-gray-900">{{ resident.voter_status }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Civil Status</span>
                        <span class="ml-auto text-gray-900">{{ resident.civil_status }}</span>
                    </div>
                    <div v-if="resident.civil_status == 'Married'">
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">Spouse Full Name</span>
                            <span class="ml-auto text-gray-900">{{ resident.spouse_name }}</span>
                        </div>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">Spouse Employment Status</span>
                            <span class="ml-auto text-gray-900">{{ resident.spouse_employment_status }}</span>
                        </div>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">Spouse Employment Sector</span>
                            <span class="ml-auto text-gray-900">{{ resident.spouse_employment_sector }}</span>
                        </div>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">Spouse Educational Attainment</span>
                            <span class="ml-auto text-gray-900">{{ resident.spouse_educational_attainment }}</span>
                        </div>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">Spouse Course</span>
                            <span class="ml-auto text-gray-900">{{ resident.spouse_course }}</span>
                        </div>
                    </div>
                </div>
                <img alt="Resident Profile Photo"
                    class="lg:w-1/2 w-full lg:h-auto lg:max-h-svh max-h-none h-64 object-cover object-center rounded"
                    :src="`/storage/${resident.resident_profile_photo_path}`"
                    v-if="resident.resident_profile_photo_path" />
                <img alt="Resident Dummy Profile Photo"
                    class="lg:w-1/2 w-full lg:h-auto lg:max-h-svh max-h-none h-64 object-cover object-center rounded"
                    src="/storage/dummy/dummy-profile.webp" v-else />
            </template>
        </ShowInformationContainer>
    </AdminLayout>
</template>
