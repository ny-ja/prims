<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <Link class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
    <div class="flex items-start">
        <div class="flex flex-col flex-shrink-0 space-y-2">
            <span class="text-gray-400">
                <slot name="title" />
            </span>
            <span class="text-lg font-semibold">
                <slot name="value" />
            </span>
        </div>
    </div>
    </Link>
</template>
