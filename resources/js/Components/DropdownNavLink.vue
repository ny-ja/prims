<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'bg-teal-700 px-3 py-2'
        : 'hover:bg-teal-700 px-3 py-2';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
