<template>
  <!-- eslint-disable max-len -->
  <header
    id="home"
    class="relative flex h-screen flex-col items-center justify-center gap-8 overflow-hidden  bg-[url(/resources/assets/heroImage_small.webp)] bg-cover bg-center bg-no-repeat"
  >
    <HeroText />
    <button
      class="group absolute bottom-12 left-1/2 -translate-x-1/2 rounded-full p-2 text-white transition-colors duration-300 hover:bg-primary-500 hover:text-transparent hover:shadow-lg"
      v-motion
      :initial="{
        opacity: 0,
        y: 0,
      }"
      :enter="{
        opacity: 1,
        transition: {
          duration: 1200,
        },
      }"
      :visible-once="{
        y: 10,
        transition: {
          repeat: Infinity,
          repeatType: 'mirror',
          duration: 1200,
        },
      }"
      @click="goToNextSection"
    >
      <Heart class="size-12 duration-300 group-hover:fill-white" />
    </button>
  </header>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import HeroText from './HeroText.vue';
import Heart from '@/shared/icons/Heart.vue';

const goToNextSection = () => {
    const infoSection = document.getElementById('welcome');
    infoSection.scrollIntoView({ behavior: 'smooth' });
};
</script>
