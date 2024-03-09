<template>
  <!-- eslint-disable max-len -->
  <GuestAreaLayout>
    <HeroSection />
    <OurStorySection />
    <CountdownSection />
  </GuestAreaLayout>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import GuestAreaLayout from '@/layouts/GuestAreaLayout.vue';
import HeroSection from '@/components/Hero/HeroSection.vue';
import OurStorySection from '@/components/Story/OurStorySection.vue';
import CountdownSection from '@/components/Countdown/CountdownSection.vue';

</script>

<style lang="postcss" scoped></style>
