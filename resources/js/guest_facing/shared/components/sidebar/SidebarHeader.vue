<template>
  <div class="w-full text-center leading-5 text-black">
    <a
      :href="route('home')"
      class="flex flex-col items-center"
    >
      <img
        class="mb-0 w-[90px] scale-x-[-1]"
        src="../../../../../assets/sunflower-100x100.png"
        alt=""
      >
      <span
        class="font-script text-4xl font-normal normal-case text-primary-500"
      >Heather <small>&</small> Adam</span>
      <h6 class="mb-2 flex items-center justify-center font-sans text-xs tracking-[5px] text-primary-800">
        {{ getFormattedWeddingDate('DD.MM.YYYY') }}
      </h6>
    </a>
  </div>
</template>

<script setup>
import useWeddingDateHelper from '../../../../shared/composables/weddingDateHelper';

const { getFormattedWeddingDate } = useWeddingDateHelper();
</script>
