<template>
  <!-- eslint-disable max-len -->
  <div
    class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img
        class="mx-auto h-10 w-auto"
        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company"
      >
      <h2
        class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
      >
        Request Password Reset
      </h2>
    </div>

    <div
      class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm"
    >
      <RequestPasswordResetForm
        @submit="submit"
        :errors="errors"
        v-if="!submitted"
      />
      <div
        v-else
        class="text-center"
      >
        {{ message }}
      </div>

      <p class="mt-10 text-center text-sm">
        <Link
          :href="route('login')"
          class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
        >
          Back to Login
        </Link>
      </p>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import RequestPasswordResetForm from '@/auth/password-reset/components/RequestPasswordResetForm.vue';

const HTTP_OK = 200;
const UNPROCESSABLE = 422;

const submitted = ref(false);
const message = ref(null);
const errors = ref({});
function submit(formData) {
    axios.post(route('password.email'), formData).then((res) => {
        if (res.status === HTTP_OK) {
            submitted.value = true;
            message.value = 'Please check your email for your password reset link.';
        }
    }).catch((err) => {
        if (err.response.status === UNPROCESSABLE) {
            errors.value = err.response.data.errors;
        } else {
            errors.value = { email: 'An error occurred. Please try again.' };
        }
    });
}

</script>
