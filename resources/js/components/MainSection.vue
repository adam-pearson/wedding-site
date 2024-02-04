<template>
    <div class="flex flex-col" id="oliven-main">
        <HeroSection />
        <FamilySection />
    </div>
</template>

<script setup>
import HeroSection from './HeroSection.vue';
import FamilySection from './FamilySection.vue';
</script>

<style lang="postcss" scoped>
#oliven-main {
    width: 78%;
    float: right;
    -webkit-transition: 0.5s;
    -o-transition: 0.5s;
    transition: 0.5s;
}
@media screen and (max-width: 1200px) {
    #oliven-main {
        width: 70%;
    }
}
@media screen and (max-width: 768px) {
    #oliven-main {
        width: 100%;
    }
}
</style>