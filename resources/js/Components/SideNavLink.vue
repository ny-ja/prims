<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
    isSidebarOpen: Boolean,
});

const classes = computed(() => {
    return [
        props.active
            ? 'flex text-white items-center p-2 space-x-2 rounded-md bg-teal-700'
            : 'flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700',
        { 'justify-center': !props.isSidebarOpen }
    ];
});
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
