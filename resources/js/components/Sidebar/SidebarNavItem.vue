<template>
  <!-- eslint-disable max-len -->
  <Link
    :href="item.route"
    class="hover:border-b-primary-500 border-b border-b-transparent font-serif text-lg leading-6 tracking-wide duration-[0.3s] hover:duration-[0.5s]"
  >
    {{ item.text }}
  </Link>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    item: {
        type: Object,
        required: true,
    },
});
</script>
