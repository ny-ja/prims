<template>
    <div>
        <textarea :type="type" :id="id" :class="computedClass" :rows="rows" :cols="cols" :placeholder="placeholder"
            :value="modelValue" @input="updateValue"></textarea>
    </div>
</template>

<script setup>
import { computed } from 'vue';

// Props
const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    id: {
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: 'text',
    },
    rows: {
        type: Number,
        default: 3,
    },
    cols: {
        type: Number,
        default: 50,
    },
    placeholder: {
        type: String,
        default: '',
    },
    additionalClasses: {
        type: String,
        default: '',
    },
});

// Emit event to update the value
const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};

// Computed class for the textarea
const computedClass = computed(() => {
    return `mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm ${props.additionalClasses}`;
});
</script>