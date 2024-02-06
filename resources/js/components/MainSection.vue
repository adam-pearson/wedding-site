<template>
    <!-- eslint-disable max-len -->
    <div
        class="transition-width flex w-full flex-col duration-[0.5s] sm:w-[calc(100%-270px)] md:w-[70%] xl:w-[78%]"
        id="oliven-main"
    >
        <HeroSection />
        <FamilySection />
    </div>
    <!-- eslint-enable max-len -->
</template>

<script setup>
import HeroSection from './HeroSection.vue';
import FamilySection from './FamilySection.vue';
</script>
