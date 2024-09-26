<template>
  <!-- eslint-disable max-len -->
  <div
    class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
  >
    <Link
      :href="route('home')"
      class="flex items-center gap-1 text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
    >
      <ChevronLeftIcon class="size-4" /> Home
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
        Log in to your account
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <LoginForm
        @submit="submit"
        :errors="errors"
      />
      <p class="mt-10 text-center text-sm ">
        <Link
          :href="route('password.request')"
          class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
        >
          Forgot Password
        </Link>
      </p>
      <p
        class="text-center text-sm text-gray-500"
        v-if="userRegistrationAllowed"
      >
        Need an Account?
        <Link
          :href="route('register')"
          class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
        >
          Register
        </Link>
      </p>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ChevronLeftIcon } from '@heroicons/vue/20/solid';
import LoginForm from '../components/LoginForm.vue';

const page = usePage();

defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

const userRegistrationAllowed = computed(() => page.props.features['user-registration']);

function submit(formData) {
    router.post(route('login'), formData);
}

</script>
