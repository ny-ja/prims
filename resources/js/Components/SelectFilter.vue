<script setup>
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps(['filters', 'routeName', 'options', 'filterKey']);

const form = useForm({
    [props.filterKey]: props.filters[props.filterKey] || ''
});

watch(() => form[props.filterKey], () => {
    form.get(route(props.routeName), {
        preserveState: true,
        replace: true,
    });
});

const filter = () => {
    form.get(route(props.routeName), {
        preserveState: true,
        replace: true,
    });
};
</script>

<template>
    <form @submit.prevent="filter" class="flex items-center space-x-2">
        <div class="items-center">
            <select v-model="form[filterKey]"
                class="px-6 py-3 rounded-md text-xs font-medium tracking-wider text-gray-500 hover:bg-gray-100 lg:max-w-sm md:py-2 md:flex-1 focus:outline-none focus:border-teal-500 focus:ring-teal-500">
                <option value="">All</option>
                <option v-for="option in options" :key="option" :value="option">{{ option }}</option>
            </select>
        </div>
    </form>
</template>
