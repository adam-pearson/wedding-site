<template>
  <!-- eslint-disable max-len -->
  <div class="flex flex-col items-center justify-center gap-4">
    <h2 class="font-serif text-4xl">
      Thank you!
    </h2>
    <p class="font-sans">
      Your RSVP response has been recorded. If you need to edit any details, please contact Adam or Heather.
    </p>
    <div v-if="canRsvpOnBehalfOf.length">
      <p>
        If you wish, you may also RSVP on behalf of the following guests:
      </p>
      <ul class="mt-2 flex flex-col overflow-hidden rounded-md bg-white shadow-sm">
        <li
          v-for="guest in canRsvpOnBehalfOf"
          :key="guest.id"
        >
          <Link
            as="a"
            :href="route('guest.rsvp.form', { code: guest.unique_code })"
            class="block py-2 hover:bg-blue-50"
          >
            {{ guest.name }}
          </Link>
        </li>
      </ul>
      <p class="mt-4">
        Or, return to the homepage
      </p>
    </div>
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
import useGuest from '../../../../shared/composables/guest';

const { canRsvpOnBehalfOf } = useGuest();

</script>
