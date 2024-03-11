<template>
  <GuestAreaLayout>
    <RsvpFormSection />
  </GuestAreaLayout>
</template>
<script setup>
import GuestAreaLayout from '@/layouts/GuestAreaLayout.vue';
import RsvpFormSection from '@/components/Rsvp/RsvpFormSection.vue';
import useGuest from '@/composables/guest';

const { setGuest } = useGuest();

const props = defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

setGuest(props.guest);

</script>
