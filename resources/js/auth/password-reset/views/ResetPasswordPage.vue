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
        Reset Password
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <ResetPasswordForm
        @submit="submit"
        :email="email"
        :token="token"
        :errors="errors"
      />

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
import axios from 'axios';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import ResetPasswordForm from '@/auth/password-reset/components/ResetPasswordForm.vue';

const token = window.location.pathname.split('/').pop();
const email = decodeURIComponent(window.location.search.split('?email=')[1]);
const errors = ref({});

function submit(formData) {
    axios.post(route('password.update'), formData).then((res) => {
        if (res.status === 200) {
            router.visit(route('login'));
        }
    }).catch((err) => {
        if (err.response.status === 422) {
            errors.value = err.response.data.errors;
        } else {
            errors.value = { error: 'An error occurred. Please try again later.' };
        }
    });
}

</script>
