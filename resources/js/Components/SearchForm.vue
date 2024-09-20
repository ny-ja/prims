<script setup>
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['filters', 'routeName', 'placeholder']);

const form = useForm({
    search: props.filters.search || ''
});

watch(() => form.search, (newSearch) => {
    if (newSearch.trim() === '') {
        Inertia.get(route(props.routeName), {}, {
            replace: true,
        });
    } else {
        form.get(route(props.routeName), {
            preserveState: true,
            replace: true,
        });
    }
});

const search = () => {
    form.get(route(props.routeName), {
        preserveState: true,
        replace: true,
    });
};
</script>

<template>
    <form @submit.prevent="search" class="flex items-center space-x-2">
        <div class="items-center flex px-2 space-x-2 md:flex-1 md:flex md:mr-auto md:ml-5">
            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <input v-model="form.search" type="text" :placeholder="placeholder"
                class="px-4 py-3 rounded-md hover:bg-gray-100 lg:max-w-sm md:py-2 md:flex-1 focus:outline-none focus:border-teal-500 focus:ring-teal-500" />
        </div>
    </form>
</template>
