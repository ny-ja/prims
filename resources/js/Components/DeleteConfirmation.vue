<script setup>
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    isOpen: {
        type: Boolean,
    },
});

const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close');
};
</script>
<template>
    <div v-if="isOpen" class="fixed inset-0 bg-teal-800 opacity-5" @click="closeModal"></div>
    <Transition name="modal">
        <div v-if="isOpen" class="fixed inset-y-0 right-0 z-50 flex flex-col bg-white shadow-lg">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button @click="closeModal" type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <Icon name="close" :classes="'size-6'" stroke="gray" fill="none" stroke_width="1.5" />
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <Icon name="exclamation" :classes="'mx-auto mb-4 text-gray-400 w-12 h-12'" stroke="white"
                            fill="none" stroke_width="1.5" />
                        <h3 class="mb-5 text-lg font-normal text-gray-500">
                            <slot name="message" />
                        </h3>
                        <slot name="button" />
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.modal-enter-active {
    transition: all 0.3s ease-out;
}

.modal-leave-active {
    transition: all 0.6s cubic-bezier(1, 0.5, 0.8, 1);
}

.modal-enter-from,
.modal-leave-to {
    transform: translateX(100%);
    opacity: 0;
}
</style>