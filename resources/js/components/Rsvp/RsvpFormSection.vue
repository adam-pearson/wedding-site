<template>
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
</template>
<script setup>
import RsvpFormCard from '@/components/Rsvp/RsvpFormCard.vue';

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
