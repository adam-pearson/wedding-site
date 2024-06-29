<template>
  <!-- eslint-disable max-len -->
  <div class="flex w-full justify-end overflow-hidden">
    <HamburgerButton
      @clicked="handleNavToggle"
      class="transition-all duration-500"
      :class="navOpen ? 'translate-x-[270px]' : 'translate-x-0'"
    />
    <Sidebar :nav-open="navOpen" />
    <div
      @click="navOpen = false"
      class="flex w-full flex-col transition-all duration-500 sm:w-[calc(100%-270px)] md:w-[76%] xl:w-[80%]"
      :class="navOpen ? 'translate-x-[270px]' : 'translate-x-0'"
    >
      <slot />
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import HamburgerButton from '../../../shared/ui/components/HamburgerButton.vue';
import Sidebar from '../components/sidebar/Sidebar.vue';

const navOpen = ref(false);

const handleNavToggle = () => {
    navOpen.value = !navOpen.value;
};
</script>
