<template>
    <div class="flex mx-auto w-full flex-wrap mb-6">
        <button v-for="tab in tabs" :key="tab.name" @click="$emit('update:currentTab', tab.name)"
            :class="{
                'border-teal-800 text-teal-800 rounded-t bg-gray-100': currentTab === tab.name
            }"
            class="sm:px-6 py-3 w-1/2 sm:w-auto mr-1 justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider hover:border-teal-800 hover:text-teal-800 hover:rounded-t hover:bg-gray-100">
            {{ tab.label }}
        </button>
    </div>
</template>

<script setup>
const props = defineProps({
    tabs: Array,
    currentTab: String
});
</script>
