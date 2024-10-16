<template>
  <Block
    :title="title"
    :loading="loading"
  >
    {{ count }}
  </Block>
</template>
<script setup>

import Block from '@/admin_facing/dashboard/components/Block.vue';

defineProps({
    title: {
        type: String,
        required: true,
    },
    count: {
        type: Number,
        required: true,
    },
    loading: {
        type: Boolean,
        required: false,
        default: false,
    },
});

</script>
