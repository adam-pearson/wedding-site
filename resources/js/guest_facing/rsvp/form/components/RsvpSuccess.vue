<template>
  <!-- eslint-disable max-len -->
  <div class="flex flex-col items-center justify-center gap-4">
    <h2 class="font-serif text-4xl">
      Thank you!
    </h2>
    <p class="font-sans">
      Your RSVP response has been recorded. If you need to edit any details, please contact Adam or Heather.
    </p>
    <Link
      as="a"
      :href="route('home')"
      class=" rounded-md bg-primary-500 px-4 py-2 text-center text-sm text-white transition duration-150 hover:bg-primary-600"
    >
      Return
    </Link>
  </div>
<!-- eslint-enable max-len -->
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
