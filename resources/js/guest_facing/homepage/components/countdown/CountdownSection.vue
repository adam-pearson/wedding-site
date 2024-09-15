<template>
  <!-- eslint-disable max-len -->
  <div
    id="countdown"
    class="flex min-h-96 flex-col items-center justify-center bg-[url(/resources/assets/countdownBackground_small.webp)] bg-cover bg-fixed bg-center bg-no-repeat py-[100px] text-center"
  >
    <div>
      <div
        v-motion
        :initial="{opacity: 0}"
        :visible-once="
          {
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
              delay: 200,
            }
          } "
      >
        <div class="mb-4">
          <h4 class="font-script text-3xl text-white md:text-6xl">
            We will become a family
            <span v-if="!weddingHasStarted"> in </span>
          </h4>
        </div>
      </div>
      <div>
        <CountdownTime
          v-if="!weddingHasStarted"
          @wedding-started="weddingHasStarted = true"
        />
        <div
          v-else
          class="countdown-time"
        >
          <h4 class="font-script text-3xl text-white md:text-6xl">
            Today!
          </h4>
        </div>
      </div>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import CountdownTime from './CountdownTime.vue';

const weddingHasStarted = ref(false);
</script>
