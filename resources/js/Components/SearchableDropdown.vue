<template>
    <div class="relative" ref="dropdown">
      <!-- Input for searching -->
      <input
        type="text"
        v-model="searchQuery"
        @focus="isOpen = true"
        @input="filterOptions"
        @keydown.escape="isOpen = false"
        class="w-full p-2 border border-gray-300 rounded focus:outline-none"
        placeholder="Select an option..."
      />
  
      <!-- Dropdown List -->
      <div v-if="isOpen" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded shadow-lg max-h-60 overflow-auto">
        <ul>
          <li
            v-for="option in filteredOptions"
            :key="option.id"
            @click="selectOption(option)"
            class="px-4 py-2 cursor-pointer hover:bg-gray-100"
          >
            {{ formatOptionLabel(option) }}
          </li>
          <li v-if="filteredOptions.length === 0" class="px-4 py-2 text-gray-500">
            No results found.
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted, onBeforeUnmount } from 'vue';
  
  const props = defineProps({
    options: {
      type: Array,
      required: true,
    },
    modelValue: {
      type: [String, Number, Object],
      default: null,
    },
    labelFields: {
      type: Array,
      default: () => ['label'], // Allows specifying custom fields for labels
    },
  });
  
  const emit = defineEmits(['update:modelValue']);
  
  const searchQuery = ref('');
  const isOpen = ref(false);
  const filteredOptions = ref([...props.options]);
  
  // Format the label using the specified fields in labelFields prop
  const formatOptionLabel = (option) => {
    return props.labelFields.map(field => option[field]).join(' ');
  };
  
  const filterOptions = () => {
    if (!searchQuery.value) {
      filteredOptions.value = [...props.options];
    } else {
      filteredOptions.value = props.options.filter((option) =>
        formatOptionLabel(option).toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    }
  };
  
  const selectOption = (option) => {
    emit('update:modelValue', option.id);
    searchQuery.value = formatOptionLabel(option);
    isOpen.value = false;
  };
  
  const dropdown = ref(null);
  
  const handleClickOutside = (event) => {
    if (dropdown.value && !dropdown.value.contains(event.target)) {
      isOpen.value = false;
    }
  };
  
  watch(() => props.options, () => {
    filterOptions();
  });
  
  onMounted(() => {
    document.addEventListener('click', handleClickOutside);
  });
  
  onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
  });
  </script>
  