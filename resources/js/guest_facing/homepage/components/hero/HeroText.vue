<template>
  <div class="text-center">
    <span class="hero-caption drop-shadow-lg">The wedding of</span>
    <h1 class="my-0 font-script text-2xl text-white drop-shadow-lg md:my-4 md:text-[7.5rem] md:leading-none">
      Heather & Adam
    </h1>
    <h2 class="hero-caption drop-shadow-lg">
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
.hero-names {
    @apply font-script;
    @apply my-0;
    @apply text-[40px];
    @apply md:text-[7.5rem];
    @apply text-white;
    @apply leading-[7.5rem];
    @apply md:my-4;
    @apply md:leading-none;
}

.hero-caption {
    @apply font-sans;
    @apply text-[12px];
    @apply md:text-xl;
    @apply tracking-[5px];
    @apply text-white;
    @apply uppercase;
}
</style>
