<script setup>
import { Link } from '@inertiajs/vue3';
import Icon from '@/Components/Icon.vue';

const props = defineProps({
    pagination: Object
});
</script>
<template>
    <div class="mt-4 flex justify-between">
        <Link v-if="pagination.prev_page_url" :href="pagination.prev_page_url"
            class="inline-flex items-center px-4 py-2 bg-teal-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <Icon name="chevron_double_left" :classes="'size-4'" stroke="white" fill="none" stroke_width="1.5" />
        Previous
        </Link>
        <Link v-if="pagination.next_page_url" :href="pagination.next_page_url"
            class="inline-flex items-center px-4 py-2 bg-teal-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Next <Icon name="chevron_double_right" :classes="'size-4'" stroke="white" fill="none" stroke_width="1.5" />

        </Link>
    </div>
</template>