<template>
  <!-- eslint-disable max-len -->
  <form @submit.prevent="submit">
    <div class="flex flex-col items-center justify-center gap-4">
      <h1 class="font-serif text-4xl font-bold">
        RSVP
      </h1>
      <p class="w-3/4 text-center text-sm sm:text-base">
        Please enter the {{ EXPECTED_LENGTH }} character code found on your invitation to RSVP.
      </p>
      <div
        class="rounded-md bg-red-50 p-4"
        v-for="error in formattedErrors"
        :key="error.id"
      >
        <div class="flex items-center justify-between">
          <div class="shrink-0">
            <XCircleIcon
              class="size-5 text-red-400"
              aria-hidden="true"
            />
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-red-800">
              {{ error.message }}
            </p>
          </div>
          <div class="ml-auto pl-3">
            <div class="-m-1.5">
              <button
                type="button"
                class="inline-flex rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50"
                @click="dismissErrors"
              >
                <span class="sr-only">Dismiss</span>
                <XMarkIcon
                  class="size-5"
                  aria-hidden="true"
                />
              </button>
            </div>
          </div>
        </div>
      </div>

      <CodeInput
        :length="EXPECTED_LENGTH"
        v-model="code"
      />
      <button
        type="submit"
        class="rounded-md bg-primary-500 px-4 py-2 font-bold text-white transition duration-75 hover:bg-primary-700 disabled:bg-gray-300"
        v-if="codeIsCorrectLength() && codeIsAlphanumeric()"
        v-motion
        :initial="{opacity: 0}"
        :visible-once="
          {
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 800,
              delay: 200,
            }
          } "
      >
        RSVP
      </button>
    </div>
  </form>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import { XCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid';
import CodeInput from '../../../../shared/form/components/CodeInput.vue';

const props = defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

const EXPECTED_LENGTH = 6;

const code = ref(localStorage.getItem('rsvpCode') ?? '');

const emit = defineEmits(['submit']);

const codeIsCorrectLength = () => code.value?.length === EXPECTED_LENGTH;
const codeIsAlphanumeric = () => code.value?.match(/^[a-zA-Z0-9]+$/);

const formattedErrors = ref(
    props.errors
    && Object.values(props.errors)
        .map((err, i) => ({ id: i, message: err })),
);

const dismissErrors = () => {
    formattedErrors.value = [];
};

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

    localStorage.setItem('rsvpCode', code.value);

    if (!validate()) {
        return false;
    }

    emit('submit', code.value);
    return true;
};

</script>
