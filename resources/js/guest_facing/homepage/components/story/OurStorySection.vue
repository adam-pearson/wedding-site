<template>
  <div
    id="story"
    class="story section-padding"
  >
    <div
      class="flex w-full flex-col gap-0 px-4 py-16 md:flex-row md:gap-4 md:py-16 lg:px-16"
    >
      <StoryImage />
      <StoryText />
    </div>
  </div>
</template>

<script setup>
import StoryImage from './StoryImage.vue';
import StoryText from './StoryText.vue';
</script>
