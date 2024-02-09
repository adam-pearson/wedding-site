<template>
    <!-- eslint-disable max-len -->
    <div
        class="flex w-full flex-col transition-width duration-[0.5s] sm:w-[calc(100%-270px)] md:w-[70%] xl:w-[78%]"
        id="oliven-main"
    >
        <HeroSection />
        <OurStorySection />
        <CountdownSection />
    </div>
    <!-- eslint-enable max-len -->
</template>

<script setup>
import HeroSection from './HeroSection.vue';
import OurStorySection from './OurStorySection.vue';
import CountdownSection from './CountdownSection.vue';
</script>
