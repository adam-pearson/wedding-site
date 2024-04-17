<template>
  <!-- eslint-disable max-len -->
  <GuestAreaLayout>
    <div class="flex h-screen items-center justify-center px-4">
      <CodeEntryPanel
        @submit="submit"
        :errors="errors"
      />
    </div>
  </GuestAreaLayout>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import { router } from '@inertiajs/vue3';
import GuestAreaLayout from '../../../shared/layouts/GuestAreaLayout.vue';
import CodeEntryPanel from '../components/CodeEntryPanel.vue';

defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

const submit = (code) => {
    // submit to server with axios
    // if any errors update errors array
    // if no errors make inertia request to go to the form page with query string
    // on back end also validate the code is correct when getting rsvp form
    // if it isn't just redir back to code entry

    router.get(route('guest.rsvp.form', { code: code.value }));
    return true;
};

</script>
