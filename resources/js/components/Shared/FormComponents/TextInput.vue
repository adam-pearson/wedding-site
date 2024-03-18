<template>
  <!-- eslint-disable max-len -->
  <div
    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600"
  >
    <BaseInput
      :label="label"
      :model-value="modelValue"
      :class="inverted ? invertedClasses : normalClasses"
      @update:model-value="emit('update:modelValue', $event)"
      v-bind="$attrs"
    />
  </div>

  <!-- eslint-enable max-len -->
</template>

<script setup>
import BaseInput from './BaseInput.vue';

defineProps({
    label: {
        type: [String, Boolean],
        default: false,
    },
    modelValue: {
        type: String,
        default: '',
    },
    inverted: {
        type: Boolean,
        default: false,
    },
});

const normalClasses = 'block flex-1 border-0 bg-transparent px-2 py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6';
const invertedClasses = 'block flex-1 border-0 bg-transparent px-2 py-1.5 text-white placeholder:text-white focus:ring-0 sm:text-sm sm:leading-6';
const emit = defineEmits(['update:modelValue']);
</script>
