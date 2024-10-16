<template>
  <!-- eslint-disable max-len -->
  <main class="bg-white">
    <div class="relative flex">
      <!-- Content -->
      <div class="w-full md:w-1/2">
        <div class="flex h-full min-h-[100dvh] flex-col after:flex-1">
          <div class="flex-1">
            <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
              <!-- Logo -->
              <Link
                class="block"
                :href="route('home')"
              >
                <svg
                  class="fill-violet-500"
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                >
                  <path d="M31.956 14.8C31.372 6.92 25.08.628 17.2.044V5.76a9.04 9.04 0 0 0 9.04 9.04h5.716ZM14.8 26.24v5.716C6.92 31.372.63 25.08.044 17.2H5.76a9.04 9.04 0 0 1 9.04 9.04Zm11.44-9.04h5.716c-.584 7.88-6.876 14.172-14.756 14.756V26.24a9.04 9.04 0 0 1 9.04-9.04ZM.044 14.8C.63 6.92 6.92.628 14.8.044V5.76a9.04 9.04 0 0 1-9.04 9.04H.044Z" />
                </svg>
              </Link>
            </div>
          </div>

          <div class="mx-auto w-full max-w-sm px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-800">
              Create your Account
            </h1>
            <!-- Form -->
            <RegisterForm
              @submit="submit"
              :errors="errors"
            />
            <!-- Footer -->
            <div class="mt-6 border-t border-gray-100 pt-5">
              <div class="text-sm">
                Have an account?
                <Link
                  class="font-medium text-violet-500 hover:text-violet-600"
                  :href="route('login')"
                >
                  Sign In
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Image -->
      <div
        class="absolute inset-y-0 right-0 hidden md:block md:w-1/2"
        aria-hidden="true"
      >
        <img
          class="size-full object-cover object-center"
          src="../images/auth-image.jpg"
          width="760"
          height="1024"
          alt="Authentication"
        >
      </div>
    </div>
  </main>
</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import RegisterForm from '@/auth/register/components/RegisterForm.vue';

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
    if (userRegistrationAllowed.value) {
        router.post(route('register'), formData);
    }
}

</script>
