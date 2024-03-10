<template>
  <div class="flex items-center justify-center h-screen">
    <form @submit.prevent="submit">
      <div class="flex flex-col items-center justify-center">
        <h1 class="text-3xl font-bold mb-4">
          RSVP
        </h1>
        <p class="text-center mb-4">
          Please enter the 5 character code found on your invitation to RSVP.
        </p>
        <div class="flex flex-col justify-center items-center">
          <NotificationBanner
            class="mb-4"
            :errors="errors"
          />
          <CodeInput
            :length="5"
            v-model="completeCode"
          />
          <button
            type="submit"
            class="mt-4 bg-primary text-white font-bold py-2 px-4 rounded-md"
          >
            RSVP
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import NotificationBanner from '@/components/Shared/NotificationBanner.vue';
import CodeInput from '@/components/Shared/FormComponents/CodeInput.vue';

const EXPECTED_LENGTH = 5;

const errors = ref([]);

const code = ref(null);

const codeIsCorrectLength = () => code.value.length === EXPECTED_LENGTH;
const codeIsAlphanumeric = () => code.value.match(/^[a-zA-Z0-9]+$/);

const getNextErrorId = () => {
    if (errors.value.length) {
        return errors.value[errors.value.length - 1].id + 1;
    }

    return 1;
};

const validate = () => {
    if (!codeIsCorrectLength()) {
        errors.value.push({ id: getNextErrorId(), message: `Code must be ${EXPECTED_LENGTH} characters long` });
    }

    if (!codeIsAlphanumeric()) {
        errors.value.push({ id: getNextErrorId(), message: 'Code must consist of letters and numbers' });
    }

    if (errors.value.length) {
        return false;
    }

    return true;
};

const submit = () => {
    // submit RSVP code using completeCode.value
    errors.value = [];

    if (!validate()) {
        return false;
    }

    // submit to server with axios
    // if any errors update errors array
    // if no errors make inertia request to go to the form page with query string
    // on back end also validate the code is correct when getting rsvp form
    // if it isn't just redir back to code entry

    return true;
};

</script>
