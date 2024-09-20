<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'flex bg-teal-700 rounded-md border border-teal-600 shadow-lg text-nowrap'
        : 'flex rounded-md border border-teal-600 shadow-lg text-nowrap hover:bg-teal-700';
});
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
