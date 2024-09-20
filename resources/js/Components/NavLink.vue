<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center h-full px-1 pt-1 border-b-2 border-teal-300 text-md font-medium leading-5 bg-teal-700 text-white focus:outline-none focus:border-teal-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center h-full px-1 pt-1 border-b-2 border-transparent text-md font-medium leading-5 text-white hover:text-white hover:bg-teal-700 hover:border-teal-300 focus:outline-none focus:text-white focus:bg-teal-700 focus:border-teal-300 transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
