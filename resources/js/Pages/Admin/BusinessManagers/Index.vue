<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import SearchForm from "@/Components/SearchForm.vue";
import Drawer from "@/Components/Drawer.vue";
import MainContentHeader from "@/Components/MainContentHeader.vue";
import TableContainer from "@/Components/TableContainer.vue";
import ButtonIcon from "@/Components/ButtonIcon.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Icon from "@/Components/Icon.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DeleteConfirmation from "@/Components/DeleteConfirmation.vue";
import SearchableDropdown from '@/Components/SearchableDropdown.vue';

const props = defineProps(["managers", "establishments", "filters"]);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref("");

const form = useForm({
    id: null,
    business_establishment_id: "",
    manager_name: "",
    manager_contact_number: "",
    manager_email: "",
});

function openDrawerForCreate() {
    form.clearErrors();
    form.reset();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(manager) {
    form.clearErrors();
    form.id = manager.id;
    form.business_establishment_id = manager.business_establishment_id;
    form.manager_name = manager.manager_name;
    form.manager_contact_number = manager.manager_contact_number;
    form.manager_email = manager.manager_email;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(manager) {
    form.id = manager.id;
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: "PUT",
        })).post(route("admin.business-managers.update", form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Manager has been successfully updated!", {
                    type: "success",
                    position: "bottom-right",
                    autoClose: 1000,
                    hideProgressBar: true,
                    transition: "flip",
                    dangerouslyHTMLString: true,
                });
                form.reset();
                isDrawerOpen.value = false;
            },
            onError: (errors) => {
                if (errors) {
                    errorMessage.value =
                        "There was an error submitting the form. Please check the fields and try again.";
                }
            },
            onFinish: () => {
                if (!form.hasErrors) {
                    errorMessage.value = "";
                }
            },
        });
    } else {
        form.post(route("admin.business-managers.store"), {
            forceFormData: true,
            onSuccess: () => {
                toast("Manager has been successfully added!", {
                    type: "success",
                    position: "bottom-right",
                    autoClose: 1000,
                    hideProgressBar: true,
                    transition: "flip",
                    dangerouslyHTMLString: true,
                });
                form.reset();
                isDrawerOpen.value = false;
            },
            onError: (errors) => {
                if (errors) {
                    errorMessage.value =
                        "There was an error submitting the form. Please check the fields and try again.";
                }
            },
            onFinish: () => {
                if (!form.hasErrors) {
                    errorMessage.value = "";
                }
            },
        });
    }
}

const deleteManager = () => {
    form.transform((data) => ({
        ...data,
        _method: "DELETE",
    })).post(route("admin.business-managers.destroy", form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Manager has been successfully deleted!", {
                type: "success",
                position: "bottom-right",
                autoClose: 1000,
                hideProgressBar: true,
                transition: "flip",
                dangerouslyHTMLString: true,
            });
            form.reset();
            isDeleteModalOpen.value = false;
        },
    });
};
</script>

<template>
    <AdminLayout title="Managers">
        <MainContentHeader>
            <template #title> Managers </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Add Manager</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.business-managers.index"
                placeholder="Search by manager name" />
        </div>

        <TableContainer>
            <template #table>
                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Business Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Manager Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Manager Contact Number
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Manager Email
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="manager in managers.data" :key="manager.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    {{ manager.business_establishment.owner_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ manager.manager_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    {{ manager.manager_contact_number }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ manager.manager_email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button @click="openDrawerForEdit(manager)"
                                    class="ml-4 text-teal-600 hover:text-teal-900">
                                    Edit
                                </button>
                                <button @click="
                                    (isDeleteModalOpen = true),
                                    openModalForDelete(manager)
                                    " class="ml-4 text-red-600 hover:text-red-900">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="managers" />
            </template>
        </TableContainer>

        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? "Edit Manager" : "Create Manager" }}
            </template>
            <template #content>
                <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
                        <div v-if="errorMessage" class="text-red-500 text-sm">
                            {{ errorMessage }}
                        </div>
                        <div>
                            <InputLabel for="business_establishment_id" value="Business Name" />

                            <SearchableDropdown :options="establishments" v-model="form.business_establishment_id"
                                :labelFields="['business_name']" />

                            <InputError :message="form.errors.business_establishment_id" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="manager_name" value="Manager Name" />
                            <TextInput id="manager_name" v-model="form.manager_name" type="text"
                                class="mt-1 block w-full" autocomplete="manager_name" />
                            <InputError :message="form.errors.manager_name" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="manager_contact_number" value="Manager Contact Number" />
                            <TextInput id="manager_contact_number" v-model="form.manager_contact_number" type="text"
                                class="mt-1 block w-full" autocomplete="manager_contact_number" />
                            <InputError :message="form.errors.manager_contact_number" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="manager_email" value="Manager Email" />
                            <TextInput id="manager_email" v-model="form.manager_email" type="email"
                                class="mt-1 block w-full" autocomplete="manager_email" />
                            <InputError :message="form.errors.manager_email" class="mt-2" />
                        </div>
                        <div class="flex justify-end">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                {{ isEditMode ? "Update" : "Create" }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </template>
        </Drawer>

        <DeleteConfirmation :isOpen="isDeleteModalOpen" @close="isDeleteModalOpen = false">
            <template #message>
                Are you sure you want to delete this manager?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteManager" class="ms-4" :class="{ 'opacity-25': form.processing }"
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
