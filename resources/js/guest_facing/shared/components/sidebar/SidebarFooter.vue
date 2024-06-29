<template>
  <!-- eslint-disable max-len -->
  <div
    class="m-0 flex flex-col items-center gap-4 pt-16 text-center text-xs tracking-wide text-gray-600"
  >
    <span class="inline-block w-20 border-b border-b-secondary-500" />
    <p>
      Heather & Adam's Wedding<br>
      {{ getFormattedWeddingDate('Do MMMM YYYY') }}
    </p>
    <Link
      v-if="!isLoggedIn"
      :href="route('login')"
      as="a"
      class="mx-auto block border-b border-b-transparent text-sm hover:border-secondary-500 hover:text-primary-500"
    >
      Login
    </Link>
    <Link
      v-else
      :href="route('logout')"
      method="post"
      as="button"
      class="mx-auto block border-b border-b-transparent text-sm hover:border-secondary-500 hover:text-primary-500"
    >
      Logout
    </Link>
  </div>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import useWeddingDateHelper from '../../../../shared/composables/weddingDateHelper';

const { getFormattedWeddingDate } = useWeddingDateHelper();

const page = usePage();

const isLoggedIn = computed(() => Boolean(page?.props?.auth?.user));
</script>
