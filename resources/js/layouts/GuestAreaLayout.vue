<template>
  <!-- eslint-disable max-len -->
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
    >
      <slot />
    </MainSection>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import HamburgerButton from '../components/Shared/HamburgerButton.vue';
import MainSection from '../components/MainSection.vue';
import SidebarSection from '../components/Sidebar/SidebarSection.vue';

const navOpen = ref(false);

const handleNavToggle = () => {
    navOpen.value = !navOpen.value;
};
</script>
