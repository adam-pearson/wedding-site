<template>
  <div class="text-center">
    <span
      class="hero-caption block drop-shadow-lg"
      v-motion
      :initial="{opacity: 0, y: -50}"
      :visible-once="
        {
          opacity: 1,
          y: 0,
          transition: {
            ease: 'easeInOut',
            duration: 1200,
          }
        } "
    >The wedding of</span>
    <h1
      class="my-0 font-script text-[2.8rem] leading-[4rem] text-white drop-shadow-lg md:my-4 md:text-[5rem] md:leading-none lg:text-[7.5rem]"
      v-motion
      :initial="{opacity: 0}"
      :visible-once="
        {
          opacity: 1,
          transition: {
            ease: 'easeInOut',
            duration: 1200,
            delay: 200,
          }
        } "
    >
      Heather & Adam
    </h1>
    <h2
      class="hero-caption drop-shadow-lg"
      v-motion
      :initial="{opacity: 0, y: 50}"
      :visible-once="
        {
          opacity: 1,
          y: 0,
          transition: {
            ease: 'easeInOut',
            duration: 1200,
          }
        } "
    >
      {{ weddingDate }}
    </h2>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import useWeddingDateHelper from '../../../../shared/composables/weddingDateHelper';

const { getFormattedWeddingDate } = useWeddingDateHelper();

const weddingDate = computed(() => getFormattedWeddingDate('Do MMMM, YYYY'));
</script>

<style lang="postcss" scoped>

.hero-caption {
    @apply font-sans;
    @apply text-[12px];
    @apply md:text-xl;
    @apply tracking-[5px];
    @apply text-white;
    @apply uppercase;
}
</style>
