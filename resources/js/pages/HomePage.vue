<template>
    <div class="flex w-full justify-end" id="oliven-page">
        <SidebarSection />
        <MainSection />
    </div>
</template>

<script setup>
import MainSection from '../components/MainSection.vue';
import SidebarSection from '../components/SidebarSection.vue';
</script>

<style lang="postcss" scoped>
#oliven-page {
    width: 100%;
    overflow: hidden;
    position: relative;
}
</style>