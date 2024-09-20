<script setup>
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    isOpen: {
        type: Boolean,
    },
});

const emit = defineEmits(['close']);

const closeDrawer = () => {
    emit('close');
};
</script>
<template>
    <div v-if="isOpen" class="fixed inset-0 bg-teal-800 opacity-5" @click="closeDrawer"></div>

    <Transition name="drawer">
        <div v-if="isOpen" class="fixed inset-y-0 right-0 z-50 flex flex-col bg-white shadow-lg w-1/2">
            <div class="flex items-center text-[#F7F5F5] justify-between flex-shrink-0 p-2 bg-teal-800">
                <h6 class="p-2 text-lg">
                    <slot name="title" />
                </h6>
                <button @click="closeDrawer"
                    class="p-1 rounded-md text-[#F7F5F5] focus:outline-none focus:ring ring-[#F7F5F5]">
                    <Icon name="close" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                </button>
            </div>
            <div class="flex-1 max-h-full p-4 overflow-auto">
                <slot name="content" />
            </div>
        </div>
    </Transition>

</template>
<style scoped>
.drawer-enter-active {
    transition: all 0.5s ease-out;
}

.drawer-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.drawer-enter-from,
.drawer-leave-to {
    transform: translateX(100%);
    opacity: 0;
}
</style>