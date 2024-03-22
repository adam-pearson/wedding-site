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
        Log in to your account
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <Vueform
        size="sm"
        class="space-y-6"
        ref="form$"
        :endpoint="false"
        @submit="submit"
      >
        <TextElement
          input-type="email"
          name="email"
          label="Email Address"
          autocomplete="email"
          :rules="['email', 'required']"
          :debounce="600"
          :columns="{container: 12, label: 12, wrapper: 12}"
        />
        <TextElement
          input-type="password"
          name="password"
          label="Password"
          autocomplete="current-password"
          classes="w-full"
          :rules="['required']"
          :columns="{container: 12, label: 12, wrapper: 12}"
        />
        <ButtonElement
          name="submit"
          button-type="button"
          button-label="Sign In"
          class="mt-4"
          full
          :submits="true"
        />
      </Vueform>
      <!-- <form
        class="space-y-6"
        @submit.prevent="submit"
      >
        <div>
          <label
            for="email"
            class="block text-sm font-medium leading-6 text-gray-900"
          >Email address</label>
          <div class="mt-2">
            <input
              v-model="form.email"
              id="email"
              name="email"
              type="email"
              autocomplete="email"
              required=""
              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            >
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label
              for="password"
              class="block text-sm font-medium leading-6 text-gray-900"
            >Password</label>
            <div class="text-sm">
              <a
                href="#"
                class="font-semibold text-indigo-600 hover:text-indigo-500"
              >Forgot password?</a>
            </div>
          </div>
          <div class="mt-2">
            <input
              v-model="form.password"
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required=""
              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            >
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Sign In
          </button>
        </div>
      </form> -->

      <p class="mt-10 text-center text-sm text-gray-500">
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
import { ref, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

const form$ = ref(null);

function submit() {
    router.post(route('login'), form$.value.requestData);
}

watch(() => props.errors, () => {
    if (Object.keys(props.errors).length === 0) return;

    Object.entries(props.errors).forEach((error) => {
        form$.value.el$(error[0]).messageBag.clear();
        form$.value.el$(error[0]).messageBag.append(error[1]);
    });
});
</script>
