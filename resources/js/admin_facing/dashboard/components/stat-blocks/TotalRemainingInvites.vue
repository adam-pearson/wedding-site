<template>
  <CountBlock
    :title="title"
    :count="count"
    :loading="loading"
  />
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import CountBlock from '@/admin_facing/dashboard/components/CountBlock.vue';

const title = ref('Total Remaining Invites');
const count = ref(0);
const loading = ref(true);

onMounted(async () => {
    const response = await axios.get(route('admin.dashboard.stats.total-remaining-invites-count'));
    count.value = response.data.count;
    loading.value = false;
});

</script>
