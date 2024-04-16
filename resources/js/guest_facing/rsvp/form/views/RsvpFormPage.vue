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

const { setGuest } = useGuest();

const props = defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

setGuest(props.guest);

</script>

<style lang="postcss" scoped>
.v-enter-active,
.v-leave-active {
  transition: opacity 1.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
