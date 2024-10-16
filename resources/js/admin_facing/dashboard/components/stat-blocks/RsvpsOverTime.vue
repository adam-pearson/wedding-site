<template>
  <LineChartBlock
    :title="title"
    :loading="loading"
    :options="options"
    :series="series"
  />
</template>
<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import LineChartBlock from '@/admin_facing/dashboard/components/LineChartBlock.vue';

const title = ref('Rsvps Over Time');
const loading = ref(true);

const options = ref({
    chart: {
        id: 'rsvp-over-time',
        height: '100%',
        type: 'line',
        toolbar: {
            show: false,
        },
    },
    xaxis: {
        categories: [],
        type: 'datetime',
        labels: {
            hideOverlappingLabels: true,
        },
    },
    yaxis: {
        min: 0,
        max: 100,
        stepSize: 5,
        labels: {
            formatter(value) {
                return value.toFixed(0);
            },
        },
    },
});

const series = ref([]);

onMounted(async () => {
    const response = await axios.get(route('admin.dashboard.stats.rsvps-over-time'));

    options.value.xaxis.categories = response.data.invite_data_by_date.map((item) => item.date);
    options.value.yaxis.max = response.data.total_invites_to_send;

    series.value = [
        {
            name: 'Invites Sent',
            data: response.data.invite_data_by_date.map((item) => item.invites_sent),
        },
        {
            name: 'RSVPs Received',
            data: response.data.invite_data_by_date.map((item) => item.rsvps_returned),
        },
    ];

    loading.value = false;
});

</script>
