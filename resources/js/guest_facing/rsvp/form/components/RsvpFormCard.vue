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
      <RsvpSuccess />
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
import RsvpCard from './RsvpCard.vue';

const welcomeOpen = ref(true);
const successOpen = ref(false);

const submit = ($event) => {
    axios.post(route('guest.rsvp.submit', { guest: $event.guest_code }), $event.formData)
        .then((res) => {
            if (res.data.success) {
                successOpen.value = true;
            }
        });
};
</script>
