<template>
  <GuestAreaLayout>
    <RsvpCard>
      <RsvpSuccess />
    </RsvpCard>
  </GuestAreaLayout>
</template>

<script setup>
import RsvpSuccess from '../components/RsvpSuccess.vue';
import GuestAreaLayout from '../../../shared/layouts/GuestAreaLayout.vue';
import RsvpCard from '../components/RsvpCard.vue';

defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

</script>
