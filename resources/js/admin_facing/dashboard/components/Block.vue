<template>
  <div
    class="h-full overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
  >
    <dt
      class="truncate text-sm font-medium text-gray-500"
      v-if="!loading"
    >
      {{ title }}
    </dt>
    <dt
      class="truncate text-sm font-medium text-gray-500"
      v-else
    >
      <Skeleton class="h-4 w-full" />
    </dt>
    <dd
      class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
      v-if="!loading"
    >
      <slot />
    </dd>
    <dd
      class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
      v-else
    >
      <Skeleton class="h-12 w-1/4" />
    </dd>
  </div>
</template>
<script setup>

import Skeleton from '@/shared/ui/components/Skeleton.vue';

defineProps({
    title: {
        type: String,
        required: true,
    },
    loading: {
        type: Boolean,
        required: false,
        default: false,
    },
});

</script>
