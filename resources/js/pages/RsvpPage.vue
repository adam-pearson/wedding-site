<template>
  <GuestAreaLayout>
    <CodeEntrySection :errors="errors" />
  </GuestAreaLayout>
</template>
<script setup>
import GuestAreaLayout from '@/layouts/GuestAreaLayout.vue';
import CodeEntrySection from '@/components/Rsvp/CodeEntrySection.vue';

defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

</script>
