<script setup>
import { computed, ref } from 'vue';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
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

const props = defineProps(["dependents", "households", "filters"]);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref("");

const headOfHouseholds = computed(() => {
    return props.households.map(household => {
        return {
            id: household.id,
            first_name: household.head_of_household.first_name,
            middle_name: household.head_of_household.middle_name,
            family_name: household.head_of_household.family_name,
        };
    });
});

const form = useForm({
    id: null,
    household_id: "",
    first_name: "",
    middle_name: "",
    family_name: "",
    birthday: "",
    birthplace: "",
    blood_type: "",
    sex: "",
    educational_attainment: "",
    course: "",
    relationship_to_head: "",
    dependent_profile_photo: null,
});

function openDrawerForCreate() {
    form.clearErrors();
    form.reset();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(dependent) {
    form.clearErrors();
    form.id = dependent.id;
    form.household_id = dependent.household_id;
    form.first_name = dependent.first_name;
    form.middle_name = dependent.middle_name;
    form.family_name = dependent.family_name;
    form.birthday = dependent.birthday;
    form.birthplace = dependent.birthplace;
    form.blood_type = dependent.blood_type;
    form.sex = dependent.sex;
    form.educational_attainment = dependent.educational_attainment;
    form.course = dependent.course;
    form.relationship_to_head = dependent.relationship_to_head;
    form.dependent_profile_photo = null;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(dependent) {
    form.id = dependent.id;
    form.first_name = dependent.first_name;
    form.middle_name = dependent.middle_name;
    form.family_name = dependent.family_name;
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: "PUT",
        })).post(route("admin.dependents.update", form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Dependent has been successfully updated!", {
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
        form.post(route("admin.dependents.store"), {
            forceFormData: true,
            onSuccess: () => {
                toast("Dependent has been successfully added!", {
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

const deleteDependent = () => {
    form.transform((data) => ({
        ...data,
        _method: "DELETE",
    })).post(route("admin.dependents.destroy", form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Dependent has been successfully deleted!", {
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
    <AdminLayout title="Dependents">
        <MainContentHeader>
            <template #title> Dependents </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Add Dependent</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.dependents.index" placeholder="Search by family name" />
        </div>

        <TableContainer>
            <template #table>
                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Full Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Head of Household
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Birthday
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Relationship to Head
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="dependent in dependents.data" :key="dependent.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img :src="`/storage/${dependent.dependent_profile_photo_path}`"
                                            alt="Dependent Profile Photo" class="w-10 h-10 rounded-full"
                                            v-if="dependent.dependent_profile_photo_path" />
                                        <img src="/storage/dummy/dummy-profile.webp" alt="Resident Dummy Profile Photo"
                                            class="w-10 h-10 rounded-full" v-else />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ dependent.first_name }}
                                            {{ dependent.middle_name }}
                                            {{ dependent.family_name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    {{
                                        dependent.household.head_of_household
                                            .first_name
                                    }}
                                    {{
                                        dependent.household.head_of_household
                                            .middle_name
                                    }}
                                    {{
                                        dependent.household.head_of_household
                                            .family_name
                                    }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ dependent.birthday }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ dependent.relationship_to_head }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <Link :href="route('admin.dependents.show', dependent)"
                                    class="text-green-600 hover:text-teal-900">Details</Link>
                                <button @click="openDrawerForEdit(dependent)"
                                    class="ml-4 text-teal-600 hover:text-teal-900">
                                    Edit
                                </button>
                                <button @click="
                                    (isDeleteModalOpen = true),
                                    openModalForDelete(dependent)
                                    " class="ml-4 text-red-600 hover:text-red-900">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="dependents" />
            </template>
        </TableContainer>

        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? "Edit Dependent" : "Create Dependent" }}
            </template>
            <template #content>
                <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
                        <div v-if="errorMessage" class="text-red-500 text-sm">
                            {{ errorMessage }}
                        </div>
                        <div>
                            <InputLabel for="first_name" value="First Name" />
                            <TextInput id="first_name" v-model="form.first_name" type="text" class="mt-1 block w-full"
                                autocomplete="first_name" />
                            <InputError :message="form.errors.first_name" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="middle_name" value="Middle Name" />
                            <TextInput id="middle_name" v-model="form.middle_name" type="text" class="mt-1 block w-full"
                                autocomplete="middle_name" />
                            <InputError :message="form.errors.middle_name" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="family_name" value="Family Name" />
                            <TextInput id="family_name" v-model="form.family_name" type="text" class="mt-1 block w-full"
                                autocomplete="family_name" />
                            <InputError :message="form.errors.family_name" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="household_id" value="Head of Household" />

                            <SearchableDropdown :options="headOfHouseholds" v-model="form.household_id"
                                :labelFields="['first_name', 'middle_name', 'family_name']" />

                            <InputError :message="form.errors.household_id" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="birthday" value="Birthday" />
                            <TextInput id="birthday" v-model="form.birthday" type="date" class="mt-1 block w-full"
                                autocomplete="birthday" />
                            <InputError :message="form.errors.birthday" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="birthplace" value="Birthplace" />
                            <TextInput id="birthplace" v-model="form.birthplace" type="text" class="mt-1 block w-full"
                                autocomplete="birthplace" />
                            <InputError :message="form.errors.birthplace" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="blood_type" value="Blood Type" />
                            <select v-model="form.blood_type" id="blood_type"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            <InputError :message="form.errors.blood_type" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="sex" value="Sex" />
                            <select v-model="form.sex" id="sex"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <InputError :message="form.errors.sex" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="educational_attainment" value="Educational Attainment" />
                            <select v-model="form.educational_attainment" id="educational_attainment"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="No Formal Education">No Formal Education</option>
                                <option value="Preschool">Preschool</option>
                                <option value="Elementary School (Grades 1-6)">Elementary School (Grades 1-6)</option>
                                <option value="Middle School (Grades 7-8)">Middle School (Grades 7-8)</option>
                                <option value="Junior High School (Grades 9-10)">Junior High School (Grades 9-10)
                                </option>
                                <option value="Senior High School (Grades 11-12)">Senior High School (Grades 11-12)
                                </option>
                                <option value="High School Diploma">High School Diploma</option>
                                <option value="Vocational Training/Certificate">Vocational Training/Certificate</option>
                                <option value="Associate Degree">Associate Degree</option>
                                <option value="Bachelor’s Degree">Bachelor’s Degree</option>
                                <option value="Postgraduate Diploma/Certificate">Postgraduate Diploma/Certificate
                                </option>
                                <option value="Master’s Degree">Master’s Degree</option>
                                <option value="Doctorate (PhD)">Doctorate (PhD)</option>
                                <option value="Postdoctoral Studies">Postdoctoral Studies</option>
                                <option value="Professional Certifications (e.g., CPA, PMP)">Professional Certifications
                                    (e.g., CPA, PMP)</option>
                                <option value="Short Courses/Workshops">Short Courses/Workshops</option>
                            </select>
                            <InputError :message="form.errors.educational_attainment" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="course" value="Course" />
                            <TextInput id="course" v-model="form.course" type="text" class="mt-1 block w-full"
                                autocomplete="course" />
                            <InputError :message="form.errors.course" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="relationship_to_head" value="Relationship to Head" />
                            <select v-model="form.relationship_to_head" id="relationship_to_head"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Spouse">Spouse</option>
                                <option value="Son">Son</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Grandfather">Grandfather</option>
                                <option value="Grandmother">Grandmother</option>
                                <option value="Grandson">Grandson</option>
                                <option value="Granddaughter">
                                    Granddaughter
                                </option>
                                <option value="Uncle">Uncle</option>
                                <option value="Aunt">Aunt</option>
                                <option value="Nephew">Nephew</option>
                                <option value="Niece">Niece</option>
                                <option value="Cousin">Cousin</option>
                                <option value="In-law">In-law</option>
                                <option value="Domestic Helper">
                                    Domestic Helper
                                </option>
                                <option value="Other Relative">
                                    Other Relative
                                </option>
                                <option value="Non-Relative">
                                    Non-Relative
                                </option>
                            </select>
                            <InputError :message="form.errors.relationship_to_head" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="dependent_profile_photo" value="dependent Profile Photo" />
                            <input type="file" @input="
                                form.dependent_profile_photo =
                                $event.target.files[0]
                                " id="dependent_profile_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.dependent_profile_photo" class="mt-2" />
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
                Are you sure you want to delete this dependent?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteDependent" class="ms-4" :class="{ 'opacity-25': form.processing }"
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
