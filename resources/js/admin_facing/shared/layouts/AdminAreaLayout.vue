<template>
  <!-- eslint-disable max-len -->
  <Sidebar />
  <div class="h-screen">
    <main class="lg:pl-72">
      <div>
        <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
          <slot />
        </div>
      </div>
    </main>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import Sidebar from '../components/sidebar/Sidebar.vue';
</script>
