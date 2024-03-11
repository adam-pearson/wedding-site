<template>
  <div class="p-4 lg:px-24">
    <div>
      <Transition
        appear
        mode="out-in"
      >
        <div
          v-if="welcomeCardClosed || welcomeCardSeen"
          key="form"
        >
          <RsvpForm />
        </div>

        <div
          v-else
          key="welcome"
        >
          <RsvpWelcomeCard @closed="closeWelcomeCard" />
        </div>
      </transition>
    </div>
  </div>
</template>
<script setup>
import { ref, computed } from 'vue';
import RsvpWelcomeCard from '@/components/Rsvp/RsvpWelcomeCard.vue';
import RsvpForm from '@/components/Rsvp/RsvpForm.vue';
import useGuest from '../../composables/guest';

const { guest } = useGuest();

const welcomeCardClosed = ref(false);
const welcomeCardSeen = computed(() => localStorage
    .getItem(`welcomeCardSeen-${guest.value.name}`) === 'true');

const closeWelcomeCard = () => {
    localStorage.setItem(`welcomeCardSeen-${guest.value.name}`, 'true');
    welcomeCardClosed.value = true;
};
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
