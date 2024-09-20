<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import MainContentHeader from "@/Components/MainContentHeader.vue";
import ShowInformationContainer from "@/Components/ShowInformationContainer.vue";
import LinkIcon from "@/Components/LinkIcon.vue";
import Icon from "@/Components/Icon.vue";

const props = defineProps(["dependent"]);
</script>

<template>
    <AdminLayout title="Dependent Information">
        <MainContentHeader>
            <template #title>
                {{ dependent.first_name }} {{ dependent.middle_name }}
                {{ dependent.family_name }} Information
            </template>
            <template #buttons>
                <LinkIcon :href="route('admin.dependents.index')">
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
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">
                        {{ dependent.first_name }} {{ dependent.middle_name }}
                        {{ dependent.family_name }}
                    </h1>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Birthday</span>
                        <span class="ml-auto text-gray-900">{{
                            dependent.birthday
                            }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Birthplace</span>
                        <span class="ml-auto text-gray-900">{{
                            dependent.birthplace
                            }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Blood Type</span>
                        <span class="ml-auto text-gray-900">{{
                            dependent.blood_type
                            }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Sex</span>
                        <span class="ml-auto text-gray-900">{{
                            dependent.sex
                            }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Educational Attainment</span>
                        <span class="ml-auto text-gray-900">{{
                            dependent.educational_attainment
                            }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Course</span>
                        <span class="ml-auto text-gray-900">{{
                            dependent.course
                            }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Head of Household</span>
                        <span class="ml-auto text-nowrap text-gray-900">{{ dependent.household.head_of_household.first_name }}
                            {{ dependent.household.head_of_household.middle_name }}
                            {{ dependent.household.head_of_household.family_name }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Relationship to Head</span>
                        <span class="ml-auto text-gray-900">{{
                            dependent.relationship_to_head
                            }}</span>
                    </div>
                </div>
                <img alt="Resident Profile Photo" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    :src="`/storage/${dependent.dependent_profile_photo_path}`"
                    v-if="dependent.dependent_profile_photo_path" />
                <img alt="Resident Dummy Profile Photo"
                    class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    src="/storage/dummy/dummy-profile.webp" v-else />
            </template>
        </ShowInformationContainer>
    </AdminLayout>
</template>
