<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import Drawer from '@/Components/Drawer.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import TableContainer from '@/Components/TableContainer.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Icon from '@/Components/Icon.vue';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DeleteConfirmation from '@/Components/DeleteConfirmation.vue';
import SearchableDropdown from '@/Components/SearchableDropdown.vue';

const props = defineProps(['households', 'headOfHouseholds', 'filters']);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    user_id: '',
    head_of_household_id: '',
    household_street_address: '',
    barangay: '',
    city: '',
    province: '',
});

function openDrawerForCreate() {
    form.clearErrors();
    form.reset();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(household) {
    form.clearErrors();
    form.id = household.id;
    form.head_of_household_id = household.head_of_household_id;
    form.household_street_address = household.household_street_address;
    form.barangay = household.barangay;
    form.city = household.city;
    form.province = household.province;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(household) {
    form.id = household.id;
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.households.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Household has been successfully updated!", {
                    "type": "success",
                    "position": "bottom-right",
                    "autoClose": 1000,
                    "hideProgressBar": true,
                    "transition": "flip",
                    "dangerouslyHTMLString": true
                })
                form.reset();
                isDrawerOpen.value = false;
            },
            onError: (errors) => {
                if (errors) {
                    errorMessage.value = 'There was an error submitting the form. Please check the fields and try again.';
                }
            },
            onFinish: () => {
                if (!form.hasErrors) {
                    errorMessage.value = '';
                }
            },
        });
    } else {
        form.post(route('admin.households.store'), {
            forceFormData: true,
            onSuccess: () => {
                toast("Household has been successfully added!", {
                    "type": "success",
                    "position": "bottom-right",
                    "autoClose": 1000,
                    "hideProgressBar": true,
                    "transition": "flip",
                    "dangerouslyHTMLString": true
                })
                form.reset();
                isDrawerOpen.value = false;
            },
            onError: (errors) => {
                if (errors) {
                    errorMessage.value = 'There was an error submitting the form. Please check the fields and try again.';
                }
            },
            onFinish: () => {
                if (!form.hasErrors) {
                    errorMessage.value = '';
                }
            },
        });
    }
}

const deleteHousehold = () => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.households.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Household has been successfully deleted!", {
                "type": "success",
                "position": "bottom-right",
                "autoClose": 1000,
                "hideProgressBar": true,
                "transition": "flip",
                "dangerouslyHTMLString": true
            })
            form.reset();
            isDeleteModalOpen.value = false;
        }
    });
};
</script>

<template>
    <AdminLayout title="Households">
        <MainContentHeader>
            <template #title>
                Households
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Add Household</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.households.index"
                placeholder="Search by head of household family name" />
        </div>

        <TableContainer>
            <template #table>
                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Head of Household</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Street Address</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Barangay</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                City</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Province</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="household in households.data" :key="household.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ household.head_of_household.first_name }} {{
                                    household.head_of_household.middle_name }} {{
                                        household.head_of_household.family_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ household.household_street_address }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ household.barangay }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ household.city }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ household.province }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <Link :href="route('admin.households.dependents', household)"
                                    class="text-green-600 hover:text-teal-900">Dependent(s)</Link>
                                <button @click="openDrawerForEdit(household)"
                                    class="ml-4 text-teal-600 hover:text-teal-900">Edit</button>
                                <button @click="isDeleteModalOpen = true, openModalForDelete(household)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="households" />
            </template>
        </TableContainer>

        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit Household' : 'Create Household' }}
            </template>
            <template #content>
                <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
                        <div v-if="errorMessage" class="text-red-500 text-sm">
                            {{ errorMessage }}
                        </div>
                        <div>
                            <InputLabel for="head_of_household_id" value="Head of Household" />

                            <SearchableDropdown :options="headOfHouseholds" v-model="form.head_of_household_id"
                                :labelFields="['first_name', 'middle_name', 'family_name']" />

                            <InputError :message="form.errors.head_of_household_id" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="household_street_address" value="Street Address" />
                            <TextInput id="household_street_address" v-model="form.household_street_address" type="text"
                                class="mt-1 block w-full" autocomplete="household_street_address" />
                            <InputError :message="form.errors.household_street_address" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="barangay" value="Barangay" />
                            <TextInput id="barangay" v-model="form.barangay" type="text" class="mt-1 block w-full"
                                autocomplete="barangay" />
                            <InputError :message="form.errors.barangay" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="city" value="City" />
                            <TextInput id="city" v-model="form.city" type="text" class="mt-1 block w-full"
                                autocomplete="city" />
                            <InputError :message="form.errors.city" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="province" value="Province" />
                            <TextInput id="province" v-model="form.province" type="text" class="mt-1 block w-full"
                                autocomplete="province" />
                            <InputError :message="form.errors.province" class="mt-2" />
                        </div>
                        <div class="flex justify-end">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                {{ isEditMode ? 'Update' : 'Create' }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </template>
        </Drawer>

        <DeleteConfirmation :isOpen="isDeleteModalOpen" @close="isDeleteModalOpen = false">
            <template #message>
                Are you sure you want to
                delete this household?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteHousehold" class="ms-4" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Yes, I'm sure
                </DeleteButton>
                <SecondaryButton @click="isDeleteModalOpen = false" class="ms-4">
                    Cancel
                </SecondaryButton>
            </template>
        </DeleteConfirmation>
    </AdminLayout>
</template>
