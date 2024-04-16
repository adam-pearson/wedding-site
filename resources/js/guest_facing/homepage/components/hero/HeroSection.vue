<template>
  <header
    id="home"
    class="hero-image flex h-screen items-center justify-center"
  >
    <HeroText />
  </header>
</template>

<script setup>
import HeroText from './HeroText.vue';
</script>

<style lang="postcss" scoped>
.hero-image {
    @apply bg-[url(/resources/assets/heroImage_small.webp)];
    @apply bg-cover;
    @apply bg-no-repeat;
    @apply bg-center;
    @apply overflow-hidden;
}
</style>
