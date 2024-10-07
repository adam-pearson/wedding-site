<template>
  <!-- eslint-disable max-len -->
  <div
    class="story-img md:mb-30 relative w-full md:w-[30%]"
    v-motion
    :initial="{opacity: 0, x: -100}"
    :visible-once="
      {
        opacity: 1,
        x: 0,
        scale: 1,
        transition: {
          ease: 'easeInOut',
          delay: 600,
          duration: 800,
        }
      } "
  >
    <div
      class="animate-box relative"
      data-animate-effect="fadeInLeft"
    >
      <div class="img relative pb-8 pl-4 pr-8">
        <img
          src="/images/story_small.webp"
          class="relative z-[2]"
          alt=""
        >
      </div>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<style lang="postcss" scoped>
.story .story-img .img:before {
    content: '';
    @apply absolute;
    @apply top-[30px];
    @apply right-0;
    @apply left-[45px];
    @apply bottom-0;
    @apply border-[10px] border-secondary-400;
}
.story .story-img:after {
    content: '';
    @apply w-[95%];
    @apply absolute;
    @apply top-[-12%];
    @apply bottom-[-25%];
    @apply left-[-2%];
    @apply bg-[url(/resources/assets/dots.svg)];
    @apply bg-repeat;
    @apply z-[-1];
    @apply text-red-500;
    @apply h-1/2;
    @apply lg:h-full;
    @apply text-secondary-500;
}
</style>
