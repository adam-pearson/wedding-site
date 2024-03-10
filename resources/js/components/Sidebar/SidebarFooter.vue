<template>
  <div
    class="m-0 flex flex-col items-center pt-16 text-center text-xs tracking-wide text-gray-600"
  >
    <span class="border-b-primary-500 my-2 inline-block w-20 border-b" />
    <p>
      Heather & Adam's Wedding<br>
      {{ getFormattedWeddingDate('Do MMMM YYYY') }}
    </p>
    <a
      v-if="!isLoggedIn"
      :href="route('login')"
      class="mx-auto block py-4 text-sm"
    >Login</a>
    <Link
      v-else
      :href="route('logout')"
      method="post"
      as="button"
      class="mx-auto block py-4 text-sm"
    >
      Logout
    </Link>
  </div>
</template>
<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import useWeddingDateHelper from '../../utils/weddingDateHelper';

const { getFormattedWeddingDate } = useWeddingDateHelper();

const page = usePage();

const isLoggedIn = computed(() => Boolean(page?.props?.auth?.user));
</script>
