<template>
  <!-- eslint-disable max-len -->
  <div class="flex h-screen items-center justify-center">
    <form @submit.prevent="submit">
      <div class="flex flex-col items-center justify-center gap-4">
        <h1 class="font-serif text-4xl font-bold">
          RSVP
        </h1>
        <p class="text-center text-sm sm:text-base">
          Please enter the {{ EXPECTED_LENGTH }} character code found on your invitation to RSVP.
        </p>
        <NotificationBanner
          class="max-w-96"
          :errors="formattedErrors"
        />
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
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import NotificationBanner from '@/components/Shared/NotificationBanner.vue';
import CodeInput from '@/components/Shared/FormComponents/CodeInput.vue';

const props = defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

const EXPECTED_LENGTH = 6;

const formattedErrors = ref(
    props.errors
    && Object.values(props.errors)
        .map((err, i) => ({ id: i, message: err })),
);

const code = ref(null);

const codeIsCorrectLength = () => code.value?.length === EXPECTED_LENGTH;
const codeIsAlphanumeric = () => code.value?.match(/^[a-zA-Z0-9]+$/);

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

    // submit to server with axios
    // if any errors update errors array
    // if no errors make inertia request to go to the form page with query string
    // on back end also validate the code is correct when getting rsvp form
    // if it isn't just redir back to code entry

    router.get(route('guest.rsvp.form', { code: code.value }));
    return true;
};

</script>
