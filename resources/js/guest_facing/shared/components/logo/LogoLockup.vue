<template>
  <div class="w-full text-center leading-5 text-black">
    <a
      :href="route('home')"
      class="flex flex-col items-center"
    >
      <Logo />
      <span
        class="font-script text-4xl font-normal normal-case text-primary-500"
      >Heather <small>&</small> Adam</span>
      <h6 class="mb-2 flex items-center justify-center font-sans text-xs tracking-[5px] text-primary-800">
        {{ getFormattedWeddingDate(dateFormat) }}
      </h6>
    </a>
  </div>
</template>

<script setup>
import useWeddingDateHelper from '../../../../shared/composables/weddingDateHelper';
import Logo from './Logo.vue';

const { getFormattedWeddingDate } = useWeddingDateHelper();

defineProps({
    dateFormat: {
        type: String,
        required: false,
        default: 'DD.MM.YYYY',
    },
});
</script>
