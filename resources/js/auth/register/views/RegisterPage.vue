<template>
  <!-- eslint-disable max-len -->
  <div
    class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
  >
    <Link
      :href="route('home')"
      class="flex items-center gap-1 text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
    >
      <ChevronLeftIcon class="size-4" /> Back
    </Link>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img
        class="mx-auto h-10 w-auto"
        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company"
      >
      <h2
        class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
      >
        Register a New Account
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <RegisterForm
        @submit="submit"
        :errors="errors"
      />

      <p class="mt-10 text-center text-sm text-gray-500">
        Already have an account?
        <Link
          :href="route('login')"
          class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
        >
          Login
        </Link>
      </p>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ChevronLeftIcon } from '@heroicons/vue/20/solid/index.js';
import RegisterForm from '../components/RegisterForm.vue';

function submit(formData) {
    router.post(route('register'), formData);
}
</script>
