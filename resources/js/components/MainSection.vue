<template>
    <!-- eslint-disable max-len -->
    <div
        class="flex w-full flex-col transition-all duration-[0.5s] sm:w-[calc(100%-270px)] md:w-[70%] xl:w-[78%]"
    >
        <HeroSection />
        <OurStorySection />
        <CountdownSection />
    </div>
    <!-- eslint-enable max-len -->
</template>

<script setup>
import HeroSection from './Hero/HeroSection.vue';
import OurStorySection from './Story/OurStorySection.vue';
import CountdownSection from './Countdown/CountdownSection.vue';
</script>
