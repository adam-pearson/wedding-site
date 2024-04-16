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
import GuestAreaLayout from '../../shared/layouts/GuestAreaLayout.vue';
import HeroSection from '../components/hero/HeroSection.vue';
import OurStorySection from '../components/story/OurStorySection.vue';
import CountdownSection from '../components/countdown/CountdownSection.vue';

</script>
