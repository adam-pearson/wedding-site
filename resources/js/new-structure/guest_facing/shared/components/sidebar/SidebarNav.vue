<template>
  <nav>
    <ul class="mx-0 mb-8 mt-0 p-0 text-center sm:mb-0">
      <li
        v-for="navItem in navItems"
        :key="navItem.text"
        class="my-[3px] pb-[3px]"
      >
        <SidebarNavItem :item="navItem" />
      </li>
    </ul>
  </nav>
</template>

<script setup>
import SidebarNavItem from './SidebarNavItem.vue';

defineProps({
    navItems: {
        type: Array,
        required: true,
    },
});
</script>
