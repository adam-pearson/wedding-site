<template>
  <GuestAreaLayout>
    <form>
      <div class="flex flex-col items-center justify-center">
        <h1 class="text-3xl font-bold mb-4">
          RSVP
        </h1>
        <p class="text-center mb-4">
          Please enter the 5 character code found on your invitation to RSVP.
        </p>
        <div class="flex justify-center">
          <input
            v-for="(input, index) in inputs"
            :key="input.id"
            v-model="input.value.value"
            @keyup="handleKeyup(index, $event)"
            :ref="input.templateRef"
            maxlength="1"
            class="w-12 h-12 text-center border-2 border-gray-300 rounded-md mr-2"
          >
        </div>
        <button
          type="submit"
          class="mt-4 bg-primary text-white font-bold py-2 px-4 rounded-md"
        >
          RSVP
        </button>
      </div>
    </form>
  </GuestAreaLayout>
</template>
<script setup>
import { ref, computed } from 'vue';
import GuestAreaLayout from '@/layouts/GuestAreaLayout.vue';

// create refs and function to, create 5 inputs, when each input is filled focus the next one

const inputs = [
    { id: 1, value: ref(null), templateRef: ref(null) },
    { id: 2, value: ref(null), templateRef: ref(null) },
    { id: 3, value: ref(null), templateRef: ref(null) },
    { id: 4, value: ref(null), templateRef: ref(null) },
    { id: 5, value: ref(null), templateRef: ref(null) },
];

const completeCode = computed(() => inputs.reduce((acc, input) => acc + (input.value.value ?? ''), ''));

const handleKeyup = (index, event) => {
    const { key } = event;
    inputs[index].value.value = key;

    if (inputs[index].value) {
        if (index < inputs.length - 1) {
            inputs[index + 1].templateRef.value[0].focus();
        }
    }
};

const submit = () => {
    // submit RSVP code using completeCode.value
};

</script>
