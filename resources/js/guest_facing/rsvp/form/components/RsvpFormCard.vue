<template>
  <!-- eslint-disable max-len -->
  <RsvpCard>
    <div v-if="welcomeOpen">
      <RsvpInvite @close-invite="welcomeOpen = false" />
    </div>
    <div v-else-if="!welcomeOpen && !successOpen">
      <RsvpForm @submit="submit" />
    </div>
    <div v-else-if="successOpen">
      <RsvpSuccess :can-rsvp-on-behalf-of="canRsvpOnBehalfOf" />
    </div>
  </RsvpCard>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import RsvpForm from './RsvpForm.vue';
import RsvpInvite from './RsvpInvite.vue';
import RsvpSuccess from './RsvpSuccess.vue';
import useGuest from '../../../../shared/composables/guest';
import RsvpCard from './RsvpCard.vue';

const { guest, canRsvpOnBehalfOf, removeFromCanRsvpOnBehalfOf } = useGuest();

const welcomeOpen = ref(true);
const successOpen = ref(false);

const submit = ($event) => {
    axios.post(route('guest.rsvp.submit', { guest: $event.guest_code }), $event.formData)
        .then((res) => {
            if (res.data.success) {
                removeFromCanRsvpOnBehalfOf(guest.value.id);
                successOpen.value = true;
            }
        });
};
</script>
