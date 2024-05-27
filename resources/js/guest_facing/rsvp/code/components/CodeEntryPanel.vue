<template>
  <!-- eslint-disable max-len -->
  <form @submit.prevent="submit">
    <div class="flex flex-col items-center justify-center gap-4">
      <h1 class="font-serif text-4xl font-bold">
        RSVP
      </h1>
      <p class="text-center text-sm sm:text-base">
        Please enter the {{ EXPECTED_LENGTH }} character code found on your invitation to RSVP.
      </p>
      <CodeInput
        :length="EXPECTED_LENGTH"
        v-model="code"
      />
      <button
        type="submit"
        class="rounded-md bg-primary-500 px-4 py-2 font-bold text-white transition duration-75 hover:bg-primary-700"
      >
        RSVP
      </button>
    </div>
  </form>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import CodeInput from '../../../../shared/form/components/CodeInput.vue';

const props = defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

const EXPECTED_LENGTH = 6;

const code = ref(null);

const emit = defineEmits(['submit']);

const codeIsCorrectLength = () => code.value?.length === EXPECTED_LENGTH;
const codeIsAlphanumeric = () => code.value?.match(/^[a-zA-Z0-9]+$/);

const formattedErrors = ref(
    props.errors
    && Object.values(props.errors)
        .map((err, i) => ({ id: i, message: err })),
);

const getNextErrorId = () => {
    if (formattedErrors.value.length) {
        return formattedErrors.value[formattedErrors.value.length - 1].id + 1;
    }

    return 1;
};

const validate = () => {
    if (!codeIsCorrectLength()) {
        formattedErrors.value.push({ id: getNextErrorId(), message: `Code must be ${EXPECTED_LENGTH} characters long` });
    }

    if (!codeIsAlphanumeric()) {
        formattedErrors.value.push({ id: getNextErrorId(), message: 'Code must consist of letters and numbers' });
    }

    if (formattedErrors.value.length) {
        return false;
    }

    return true;
};

const submit = () => {
    // submit RSVP code using completeCode.value
    formattedErrors.value = [];

    if (!validate()) {
        return false;
    }

    emit('submit', code.value);
    return true;
};

</script>
