<template>
  <!-- eslint-disable max-len -->
  <div class="flex gap-1 sm:gap-2">
    <input
      v-for="(input, index) in inputs"
      v-model="input.inputValue.value"
      maxlength="1"
      class="size-8 rounded-md border-2 border-gray-300 p-0 text-center text-sm transition duration-75 hover:border-primary-500 focus:border-[3px] focus:border-primary-500 focus:ring-0 sm:size-12 sm:text-base"
      :key="input.id"
      :ref="input.templateRef"
      :value="getCharFromModelValue(index)"
      @keypress="handleKeyup(index, $event)"
      @paste="handlePaste(index, $event)"
    >
  </div>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import {
    ref, computed, onBeforeMount,
} from 'vue';

const props = defineProps({
    length: {
        type: Number,
        required: true,
    },
    modelValue: {
        type: [String, null],
        required: true,
    },
});

const inputs = [];

const completeCode = computed(() => inputs.reduce((acc, input) => acc + (input.inputValue.value ?? ''), ''));

const emit = defineEmits('update:modelValue');

const getCharFromModelValue = (index) => props.modelValue?.charAt(index) ?? '';

const handleKeyup = (index, event) => {
    const { key, ctrlDown } = event;
    if (key.match(/^[a-zA-Z0-9]$/) && !ctrlDown) {
        inputs[index].inputValue.value = key;
        if (inputs[index].inputValue.value) {
            if (index < inputs.length - 1) {
                inputs[index + 1].templateRef.value[0].focus();
            }
        }
        emit('update:modelValue', completeCode.value);
    }
};

const handlePaste = (index, event) => {
    event.preventDefault();
    const pastedData = event.clipboardData.getData('text');
    if (pastedData.length === props.length) {
        for (let i = 0; i < pastedData.length; i += 1) {
            inputs[i].inputValue.value = pastedData.charAt(i);
        }
        emit('update:modelValue', completeCode.value);
    }
};

onBeforeMount(() => {
    for (let i = 0; i < props.length; i += 1) {
        inputs.push({
            id: i + 1,
            inputValue: ref(getCharFromModelValue(i)),
            templateRef: ref(null),
        });
    }
});
</script>
