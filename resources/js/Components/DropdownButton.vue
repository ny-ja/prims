<script setup>
import { ref, computed } from "vue";
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    isSidebarOpen: Boolean,
    active: Boolean,
});

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const classes = computed(() => {
    return [
        props.active
            ? 'flex text-white items-center p-2 rounded-md bg-teal-700 cursor-pointer'
            : 'flex text-white items-center p-2 rounded-md hover:bg-teal-700 cursor-pointer',
        [!props.isSidebarOpen ? 'justify-center flex-col' : 'justify-between']
    ];
});
</script>
<template>
    <div @click="toggleDropdown" :class="classes">
        <div class="flex space-x-2">
            <slot name="icon" />

            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">
                <slot name="text" />
            </span>
        </div>

        <Icon name="chevron" :classes="'size-5'" />
    </div>
    <ul class="border border-teal-500 mt-1 p-2 rounded-lg"
        :class="isDropdownOpen ? 'py-2 space-y-1' : 'hidden py-2 space-y-1'">
        <slot name="nav" />
    </ul>
</template>