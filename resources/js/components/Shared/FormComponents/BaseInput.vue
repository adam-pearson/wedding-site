<template>
  <input
    :value="modelValue"
    @input="emit('update:modelValue', $event.target.value)"
    v-bind="$attrs"
  >
</template>

<script setup>
defineProps({
    label: {
        type: [String, Boolean],
        default: false,
    },
    modelValue: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['update:modelValue']);
</script>
