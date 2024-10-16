<template>
  <Block
    :title="title"
    :loading="loading"
    class="flex flex-col items-stretch"
  >
    <apexchart
      width="100%"
      type="line"
      :options="options"
      :series="series"
    />
  </Block>
</template>
<script setup>
import Block from './Block.vue';

defineProps({
    title: {
        type: String,
        required: true,
    },
    loading: {
        type: Boolean,
        required: true,
    },
    options: {
        type: Object,
        required: true,
    },
    series: {
        type: Array,
        required: true,
    },
});

</script>
