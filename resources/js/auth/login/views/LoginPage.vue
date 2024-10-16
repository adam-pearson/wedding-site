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
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                >
                  <defs>
                    <linearGradient
                      x1="28.538%"
                      y1="20.229%"
                      x2="100%"
                      y2="108.156%"
                      id="logo-a"
                    >
                      <stop
                        stop-color="#B7ACFF"
                        stop-opacity="0"
                        offset="0%"
                      />
                      <stop
                        stop-color="#B7ACFF"
                        offset="100%"
                      />
                    </linearGradient>
                    <linearGradient
                      x1="88.638%"
                      y1="29.267%"
                      x2="22.42%"
                      y2="100%"
                      id="logo-b"
                    >
                      <stop
                        stop-color="#7BC8FF"
                        stop-opacity="0"
                        offset="0%"
                      />
                      <stop
                        stop-color="#7BC8FF"
                        offset="100%"
                      />
                    </linearGradient>
                  </defs>
                  <rect
                    fill="#8470FF"
                    width="32"
                    height="32"
                    rx="16"
                  />
                  <path
                    d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z"
                    fill="#755FF8"
                  />
                  <path
                    d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z"
                    fill="url(#logo-a)"
                  />
                  <path
                    d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z"
                    fill="url(#logo-b)"
                  />
                </svg>
              </Link>
            </div>
          </div>

          <div class="mx-auto w-full max-w-sm px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-800">
              Welcome back!
            </h1>
            <LoginForm
              @submit="submit"
              :errors="errors"
            />
            <Link
              :href="route('password.request')"
              class="mt-4 flex w-full justify-center text-center text-sm font-semibold leading-6 text-violet-500 hover:text-violet-600"
            >
              Forgot Password
            </Link>
            <!-- Footer -->
            <div
              class="mt-6 border-t border-gray-200 pt-5"
              v-if="userRegistrationAllowed"
            >
              <div class="text-sm">
                Need an account? <Link
                  class="font-medium text-violet-500 hover:text-violet-600"
                  :href="route('register')"
                >
                  Sign Up
                </Link>
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
            alt=""
          >
        </div>
      </div>
    </div>
  </main>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import LoginForm from '@/auth/login/components/LoginForm.vue';

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
