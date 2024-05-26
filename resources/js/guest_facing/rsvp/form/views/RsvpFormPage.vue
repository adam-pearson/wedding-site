<template>
  <GuestAreaLayout>
    <div class="p-4 lg:px-24">
      <div>
        <Transition
          appear
          mode="out-in"
        >
          <RsvpFormCard />
        </transition>
      </div>
    </div>
  </GuestAreaLayout>
</template>
<script setup>
import GuestAreaLayout from '../../../shared/layouts/GuestAreaLayout.vue';
import RsvpFormCard from '../components/RsvpFormCard.vue';
import useGuest from '../../../../shared/composables/guest';

const { setGuest, canRsvpOnBehalfOf, setCanRsvpOnBehalfOf } = useGuest();

const props = defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

setGuest(props.guest);
console.log('canRsvp On behalf of', canRsvpOnBehalfOf);
if (canRsvpOnBehalfOf.value.length === 0) {
    setCanRsvpOnBehalfOf(props.guest.rsvp_on_behalf_of);
}

</script>

<style lang="postcss" scoped>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.75s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
