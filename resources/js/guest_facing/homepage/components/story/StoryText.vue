<template>
  <!-- eslint-disable max-len -->
  <div
    class="w-full p-4 md:w-[70%] md:py-0"
  >
    <div
      class="flex flex-col gap-4"
    >
      <div
        v-motion
        :initial="{opacity: 0, x: 100}"
        :visible-once="
          {
            opacity: 1,
            x: 0,
            scale: 1,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
            }
          } "
      >
        <h4
          class="relative top-3 pb-6 font-script text-3xl leading-3 text-primary-300"
        >
          Our love
        </h4>
        <h3
          class="font-serif text-3xl font-medium uppercase tracking-wider text-primary-500"
        >
          Our Story
        </h3>
      </div>
      <div
        v-motion
        :initial="{opacity: 0, x: 100}"
        :visible-once="
          {
            opacity: 1,
            x: 0,
            scale: 1,
            transition: {
              ease: 'easeInOut',
              delay: 300,
              duration: 1200,
            }
          } "
      >
        <p class="font-sans text-sm text-gray-700">
          Adam and Heather's love story began unexpectedly on April 27th,
          2019, at a wine festival they both attended last-minute after
          some spaces became free. Despite not planning to be there, they
          crossed paths and hit it off instantly. When COVID-19 hit, they
          were separated physically but stayed connected through daily
          Skype calls. In 2021, Heather moved in with Adam and his parents
          for what was meant to be a short stay during lockdown, but it
          turned into over a year.
        </p>
      </div>
      <div
        v-motion
        :initial="{opacity: 0, x: 100}"
        :visible-once="
          {
            opacity: 1,
            x: 0,
            scale: 1,
            transition: {
              ease: 'easeInOut',
              delay: 600,
              duration: 1200,
            }
          } "
      >
        <h4 class="font-serif text-2xl font-medium text-primary-500">
          Dec 16th, 2023, she Said Yes!
        </h4>
        <p class="font-sans text-sm text-gray-700">
          After renovating their house, which they bought together the
          year before, Adam surprised Heather with a proposal on December
          16th, 2023, at Surprise View in the Lake District. Overlooking
          the stunning scenery, he asked her to be his partner for life,
          and she accepted. Their journey, from a chance meeting at a wine
          festival to a heartfelt proposal amidst nature's beauty, is a
          testament to the strength of their love and commitment through
          life's unpredictable twists and turns.
        </p>
      </div>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<style lang="postcss" scoped>
.story-text p {
    @apply font-sans;
    @apply leading-7;
    @apply text-gray-500;
    @apply text-sm;
}
</style>
<script setup lang="ts">
</script>
