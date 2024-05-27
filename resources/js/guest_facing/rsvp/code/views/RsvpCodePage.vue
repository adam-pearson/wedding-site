<template>
  <!-- eslint-disable max-len -->
  <GuestAreaLayout>
    <div class="flex h-screen items-center justify-center px-4">
      <CodeEntryPanel
        @submit="submit($event)"
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
    router.get(route('guest.rsvp.form', { code }));
};

</script>
