<template>
  <!-- eslint-disable max-len -->
  <div class="flex w-full items-center justify-center gap-1 sm:gap-2">
    <input
      v-for="(input, index) in inputs"
      v-model="input.inputValue.value"
      class="border-1 size-10 rounded-md border-transparent p-0 text-center shadow-md shadow-primary-500/30 transition duration-75 hover:border-primary-500/40 hover:text-sm focus:border-primary-500 focus:ring-0 sm:size-14 sm:text-base"
      :key="input.id"
      :ref="input.templateRef"
      :value="getCharFromModelValue(index)"
      @focus="handleFocus()"
      @input="handleInput(index, $event)"
      @paste="handlePaste"
      @keydown.delete="handleDelete(index)"
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

const emit = defineEmits(['update:modelValue']);

const getCharFromModelValue = (index) => props.modelValue?.charAt(index) ?? ' ';

const handleFocus = () => {
    let focused = false;
    // Focus on the next empty input
    inputs.forEach((input) => {
        if (focused) {
            return;
        }
        if (!input.inputValue.value.trim()) {
            input.templateRef.value[0].focus();
            focused = true;
        }
    });
    // If all inputs are filled, focus on the last input
    if (!focused) {
        inputs[inputs.length - 1].templateRef.value[0].focus();
    }
};
const handleDelete = (index) => {
    if (inputs[index].inputValue.value.trim()) {
        inputs[index].inputValue.value = ' ';
    } else if (index > 0) {
        inputs[index - 1].inputValue.value = ' ';
    }

    if (index > 0) {
        inputs[index - 1].templateRef.value[0].focus();
    }

    if (index === 0) {
        inputs[index].templateRef.value[0].focus();
    }

    emit('update:modelValue', completeCode.value);
};

const handleTextInput = (index, data) => {
    inputs[index].inputValue.value = data.toUpperCase();
    if (inputs[index].inputValue.value) {
        if (index < inputs.length - 1) {
            inputs[index + 1].templateRef.value[0].focus();
        }
    }
    emit('update:modelValue', completeCode.value);
};

const handlePaste = (event) => {
    event.preventDefault();
    const pastedData = event.clipboardData.getData('text');
    if (pastedData.length === props.length) {
        for (let i = 0; i < pastedData.length; i += 1) {
            inputs[i].inputValue.value = pastedData.charAt(i);
        }
        emit('update:modelValue', completeCode.value);
    }

    handleFocus();
};

const handleInput = (index, event) => {
    const deleteKeys = ['deleteContentBackward', 'deleteContentForward'];
    const pasteInputType = 'insertFromPaste';
    const { data, inputType } = event;

    const inputIsDelete = deleteKeys.includes(inputType);
    const inputIsPaste = inputType === pasteInputType;

    if (!inputIsPaste && !inputIsDelete && data.match(/^[a-zA-Z0-9]$/)) {
        handleTextInput(index, data);
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
