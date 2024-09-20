<script setup>
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import SelectFilter from '@/Components/SelectFilter.vue';
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

const props = defineProps(['residents', 'filters']);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    first_name: '',
    middle_name: '',
    family_name: '',
    contact_number: '',
    email: '',
    birthday: '',
    birthplace: '',
    blood_type: '',
    sex: '',
    street_address: '',
    employment_status: '',
    employment_sector: '',
    educational_attainment: '',
    course: '',
    social_classification: '',
    voter_status: '',
    civil_status: '',
    spouse_name: '',
    spouse_employment_status: '',
    spouse_employment_sector: '',
    spouse_educational_attainment: '',
    spouse_course: '',
    resident_profile_photo: null,

});

function openDrawerForCreate() {
    form.clearErrors();
    form.reset();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(resident) {
    form.clearErrors();
    form.id = resident.id;
    form.first_name = resident.first_name;
    form.middle_name = resident.middle_name;
    form.family_name = resident.family_name;
    form.contact_number = resident.contact_number;
    form.email = resident.email;
    form.birthday = resident.birthday;
    form.birthplace = resident.birthplace;
    form.blood_type = resident.blood_type;
    form.sex = resident.sex;
    form.street_address = resident.street_address;
    form.employment_status = resident.employment_status;
    form.employment_sector = resident.employment_sector;
    form.educational_attainment = resident.educational_attainment;
    form.course = resident.course;
    form.social_classification = resident.social_classification;
    form.voter_status = resident.voter_status;
    form.civil_status = resident.civil_status;
    form.spouse_name = resident.spouse_name;
    form.spouse_employment_status = resident.spouse_employment_status;
    form.spouse_employment_sector = resident.spouse_employment_sector;
    form.spouse_educational_attainment = resident.spouse_educational_attainment;
    form.spouse_course = resident.spouse_course;
    form.resident_profile_photo = null;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(resident) {
    form.id = resident.id;
    form.first_name = resident.first_name;
    form.middle_name = resident.middle_name;
    form.family_name = resident.family_name;
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.residents.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Resident has been successfully updated!", {
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
        form.post(route('admin.residents.store'), {
            forceFormData: true,
            onSuccess: () => {
                toast("Resident has been successfully added!", {
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

const deleteResident = () => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.residents.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Resident has been successfully deleted!", {
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
    <AdminLayout title="Residents">
        <MainContentHeader>
            <template #title>
                Residents
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Add Resident</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.residents.index" placeholder="Search by family name" />
        </div>

        <TableContainer>
            <template #filter>
                <SelectFilter :filters="filters" routeName="admin.residents.index"
                    :options="['Registered Voter', 'Non-Registered Voter']" filterKey="voter_status" />
            </template>

            <template #download>
                <form method="GET" :action="route('admin.residents.index')">
                    <input type="hidden" name="search" :value="filters.search">
                    <input type="hidden" name="voter_status" :value="filters.voter_status">
                    <button type="submit" name="export" value="1"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </button>
                </form>
            </template>

            <template #table>
                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Full Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Contact</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Email</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="resident in residents.data" :key="resident.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img :src="`/storage/${resident.resident_profile_photo_path}`"
                                            alt="Resident Profile Photo" class="w-10 h-10 rounded-full"
                                            v-if="resident.resident_profile_photo_path" />
                                        <img src="/storage/dummy/dummy-profile.webp" alt="Resident Dummy Profile Photo"
                                            class="w-10 h-10 rounded-full" v-else />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ resident.first_name }} {{
                                            resident.middle_name }} {{ resident.family_name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ resident.contact_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ resident.email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <Link :href="route('admin.residents.show', resident)"
                                    class="text-green-600 hover:text-teal-900">Details</Link>
                                <button @click="openDrawerForEdit(resident)"
                                    class="ml-4 text-teal-600 hover:text-teal-900">Edit</button>
                                <button @click="isDeleteModalOpen = true, openModalForDelete(resident)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="residents" />
            </template>
        </TableContainer>

        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit Resident' : 'Create Resident' }}
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
                            <InputLabel for="contact_number" value="Contact Number" />
                            <TextInput id="contact_number" v-model="form.contact_number" type="text"
                                class="mt-1 block w-full" autocomplete="contact_number" />
                            <InputError :message="form.errors.contact_number" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full"
                                autocomplete="email" />
                            <InputError :message="form.errors.email" class="mt-2" />
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
                            <InputLabel for="street_address" value="Street Address" />
                            <TextInput id="street_address" v-model="form.street_address" type="text"
                                class="mt-1 block w-full" autocomplete="street_address" />
                            <InputError :message="form.errors.street_address" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="employment_status" value="Employment Status" />
                            <select v-model="form.employment_status" id="employment_status"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Employed">Employed</option>
                                <option value="Unemployed">Unemployed</option>
                                <option value="Dependent">Dependent</option>
                                <option value="Studying">Studying</option>
                            </select>
                            <InputError :message="form.errors.employment_status" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="employment_sector" value="Employment Sector" />
                            <select v-model="form.employment_sector" id="employment_sector"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Public">Public</option>
                                <option value="Local Government">Local Government</option>
                                <option value="Government Agency">Government Agency</option>
                                <option value="Private">Private</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Academe">Academe</option>
                                <option value="Business-Company">Business-Company</option>
                                <option value="Business-Proprietorship">Business-Proprietorship</option>
                                <option value="ICT">ICT</option>
                                <option value="Overseas">Overseas</option>
                                <option value="Others">Others</option>
                            </select>
                            <InputError :message="form.errors.employment_sector" class="mt-2" />
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
                            <InputLabel for="social_classification" value="Social Classification" />
                            <select v-model="form.social_classification" id="social_classification"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Formal">Formal</option>
                                <option value="Indigent">Indigent</option>
                                <option value="Solo Parent">Solo Parent</option>
                                <option value="PWD">PWD</option>
                                <option value="Indigenous">Indigenous</option>
                                <option value="Senior Citizen">Senior Citizen</option>
                            </select>
                            <InputError :message="form.errors.social_classification" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="voter_status" value="Voter Status" />
                            <select v-model="form.voter_status" id="voter_status"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Registered Voter">Registered Voter</option>
                                <option value="Non-Registered Voter">Non-Registered Voter</option>
                            </select>
                            <InputError :message="form.errors.voter_status" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="civil_status" value="Civil Status" />
                            <select v-model="form.civil_status" id="civil_status"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Separated">Separated</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Annulled">Annulled</option>
                                <option value="Domestic Partnership">Domestic Partnership</option>
                                <option value="Civil Union">Civil Union</option>
                            </select>
                            <InputError :message="form.errors.civil_status" class="mt-2" />
                        </div>
                        <div v-if="form.civil_status == 'Married'">
                            <div>
                                <InputLabel for="spouse_name" value="Spouse Full Name" />
                                <TextInput id="spouse_name" v-model="form.spouse_name" type="text"
                                    class="mt-1 block w-full" autocomplete="spouse_name"
                                    placeholder="ex. Johnny Gwapo Ermio" required />
                                <InputError :message="form.errors.spouse_name" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="spouse_employment_status" value="Spouse Employment Status" />
                                <select v-model="form.spouse_employment_status" id="spouse_employment_status"
                                    class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full"
                                    required>
                                    <option value="Employed">Employed</option>
                                    <option value="Unemployed">Unemployed</option>
                                    <option value="Dependent">Dependent</option>
                                    <option value="Studying">Studying</option>
                                </select>
                                <InputError :message="form.errors.spouse_employment_status" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="spouse_employment_sector" value="Spouse Employment Sector" />
                                <select v-model="form.spouse_employment_sector" id="spouse_employment_sector"
                                    class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full"
                                    required>
                                    <option value="Public">Public</option>
                                    <option value="Local Government">Local Government</option>
                                    <option value="Government Agency">Government Agency</option>
                                    <option value="Private">Private</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Academe">Academe</option>
                                    <option value="Business-Company">Business-Company</option>
                                    <option value="Business-Proprietorship">Business-Proprietorship</option>
                                    <option value="ICT">ICT</option>
                                    <option value="Overseas">Overseas</option>
                                    <option value="Others">Others</option>
                                </select>
                                <InputError :message="form.errors.spouse_employment_sector" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="spouse_educational_attainment" value="Spouse Employment Sector" />
                                <select v-model="form.spouse_educational_attainment" id="spouse_educational_attainment"
                                    class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full"
                                    required>
                                    <option value="No Formal Education">No Formal Education</option>
                                    <option value="Preschool">Preschool</option>
                                    <option value="Elementary School (Grades 1-6)">Elementary School (Grades 1-6)
                                    </option>
                                    <option value="Middle School (Grades 7-8)">Middle School (Grades 7-8)</option>
                                    <option value="Junior High School (Grades 9-10)">Junior High School (Grades 9-10)
                                    </option>
                                    <option value="Senior High School (Grades 11-12)">Senior High School (Grades 11-12)
                                    </option>
                                    <option value="High School Diploma">High School Diploma</option>
                                    <option value="Vocational Training/Certificate">Vocational Training/Certificate
                                    </option>
                                    <option value="Associate Degree">Associate Degree</option>
                                    <option value="Bachelor’s Degree">Bachelor’s Degree</option>
                                    <option value="Postgraduate Diploma/Certificate">Postgraduate Diploma/Certificate
                                    </option>
                                    <option value="Master’s Degree">Master’s Degree</option>
                                    <option value="Doctorate (PhD)">Doctorate (PhD)</option>
                                    <option value="Postdoctoral Studies">Postdoctoral Studies</option>
                                    <option value="Professional Certifications (e.g., CPA, PMP)">Professional
                                        Certifications
                                        (e.g., CPA, PMP)</option>
                                    <option value="Short Courses/Workshops">Short Courses/Workshops</option>
                                </select>
                                <InputError :message="form.errors.spouse_educational_attainment" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="spouse_course" value="Spouse Course" />
                                <TextInput id="spouse_course" v-model="form.spouse_course" type="text"
                                    class="mt-1 block w-full" autocomplete="spouse_course" required />
                                <InputError :message="form.errors.spouse_course" class="mt-2" />
                            </div>
                        </div>
                        <div>
                            <InputLabel for="resident_profile_photo" value="Resident Profile Photo" />
                            <input type="file" @input="form.resident_profile_photo = $event.target.files[0]"
                                id="resident_profile_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.resident_profile_photo" class="mt-2" />
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
                delete this resident?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteResident" class="ms-4" :class="{ 'opacity-25': form.processing }"
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
