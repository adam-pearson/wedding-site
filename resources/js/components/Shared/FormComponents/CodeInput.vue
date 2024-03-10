<template>
  <div class="flex">
    <input
      v-for="(input, index) in inputs"
      :key="input.id"
      v-model="input.inputValue.value"
      @keyup="handleKeyup(index, $event)"
      :ref="input.templateRef"
      maxlength="1"
      :value="getCharFromModelValue(index)"
      class="w-12 h-12 text-center border-2 border-gray-300 rounded-md mr-2"
    >
  </div>
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
    const { key } = event;
    if (key.match(/^[a-zA-Z0-9]$/)) {
        inputs[index].inputValue.value = key;
        if (inputs[index].inputValue.value) {
            if (index < inputs.length - 1) {
                inputs[index + 1].templateRef.value[0].focus();
            }
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
