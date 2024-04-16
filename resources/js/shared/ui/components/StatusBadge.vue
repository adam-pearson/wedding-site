<template>
  <!-- eslint-disable max-len -->
  <span
    class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset"
    :class="STATUS_TYPES[status.toUpperCase()].classes"
  >{{ STATUS_TYPES[status.toUpperCase()].displayName }}</span>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import STATUS_TYPES from '../../constants/inviteStatuses';

defineProps({
    status: {
        type: String,
        required: true,
    },
});
</script>
