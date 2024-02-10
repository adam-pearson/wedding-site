<template>
    <div class="flex w-full justify-end overflow-hidden">
        <HamburgerButton
            @clicked="handleNavToggle"
            class="transition-all duration-500"
            :class="navOpen ? 'translate-x-[270px]' : 'translate-x-0'"
        />
        <SidebarSection :nav-open="navOpen" />
        <MainSection
            @click="navOpen = false"
            class="transition-all duration-500"
            :class="navOpen ? 'translate-x-[270px]' : 'translate-x-0'"
        />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import MainSection from '../components/MainSection.vue';
import SidebarSection from '../components/Sidebar/SidebarSection.vue';
import HamburgerButton from '../components/Shared/HamburgerButton.vue';

const navOpen = ref(false);

const handleNavToggle = () => {
    navOpen.value = !navOpen.value;
};
</script>

<style lang="postcss" scoped></style>
