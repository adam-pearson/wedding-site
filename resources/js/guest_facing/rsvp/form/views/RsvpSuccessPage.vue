<template>
  <GuestAreaLayout>
    <RsvpCard>
      <RsvpSuccess :can-rsvp-on-behalf-of="canRsvpOnBehalfOf" />
    </RsvpCard>
  </GuestAreaLayout>
</template>

<script setup>
import { computed } from 'vue';
import RsvpSuccess from '../components/RsvpSuccess.vue';
import GuestAreaLayout from '../../../shared/layouts/GuestAreaLayout.vue';
import RsvpCard from '../components/RsvpCard.vue';
import useGuest from '../../../../shared/composables/guest';

const { canRsvpOnBehalfOf, setCanRsvpOnBehalfOf } = useGuest();

const props = defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

if (canRsvpOnBehalfOf.value.length === 0) {
    setCanRsvpOnBehalfOf(props.guest.rsvp_on_behalf_of);
}

</script>
