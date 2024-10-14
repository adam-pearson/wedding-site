<template>
  <AdminAreaLayout>
    <div>
      <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div
          v-for="block in statBlocks"
          :key="block.title"
          class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
        >
          <dt class="truncate text-sm font-medium text-gray-500">
            {{ block.title }}
          </dt>
          <dd
            class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
            v-if="block.type === 'count'"
          >
            {{ block.data?.count }}
          </dd>
          <dd
            class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
            v-else-if="block.type === 'line-chart'"
          >
            <apexchart
              width="500"
              type="line"
              :options="block.options"
              :series="block.series"
              v-if="block.loaded"
            />
          </dd>
        </div>
      </dl>
    </div>
  </AdminAreaLayout>
</template>

<script setup>
import axios from 'axios';
import { onBeforeMount, reactive, ref } from 'vue';
import AdminAreaLayout from '../../shared/layouts/AdminAreaLayout.vue';

const statBlocks = reactive({
    'total-guests-attending': {
        title: 'Total Guests Attending',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.total-attending-count'),
        type: 'count',
        data: null,
        loaded: false,
        options: null,
    },
    'total-non-guests-attending': {
        title: 'Total Non-Guests Attending',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.total-non-guest-attending-count'),
        type: 'count',
        data: null,
        loaded: false,
        options: null,
    },
    'total-remaining-invites': {
        title: 'Total Remaining Invites To Send',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.total-remaining-invites-count'),
        type: 'count',
        data: null,
        loaded: false,
        options: null,
    },
    'total-remaining-rsvps': {
        title: 'Total RSVP Responses Waiting For',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.total-remaining-rsvps-count'),
        type: 'count',
        data: null,
        loaded: false,
        options: null,
    },
    'total-children-attending': {
        title: 'Total Children Attending',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.total-children-attending-count'),
        type: 'count',
        data: null,
        loaded: false,
        options: null,
    },
    'rsvp-over-time': {
        title: 'RSVP Over Time',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.rsvp-over-time'),
        type: 'line-chart',
        data: null,
        loaded: false,
        options: null,
    },
    'attendance-ratio': {
        title: 'Attendance Ratio',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.attendance-ratio'),
        data: null,
        loaded: false,
        options: null,
    },
    'alcohol-ratio': {
        title: 'Alcohol Ratio',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.alcohol-ratio'),
        data: null,
        loaded: false,
        options: null,
    },
    'day-attendance-ratio': {
        title: 'Day Attendance Ratio',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.day-attendance-ratio'),
        data: null,
        loaded: false,
        options: null,
    },
    'evening-attendance-ratio': {
        title: 'Evening Attendance Ratio',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.evening-attendance-ratio'),
        data: null,
        loaded: false,
        options: null,
    },
    'plus-one-usage': {
        title: 'Plus One Usage',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.plus-one-usage'),
        data: null,
        loaded: false,
        options: null,
    },
    'not-yet-responded': {
        title: 'Not Yet Responded',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.not-yet-responded'),
        loaded: false,
        options: null,
    },
    'not-attending': {
        title: 'Not Attending',
        subtitle: null,
        endpoint: route('admin.dashboard.stats.not-attending'),
        data: null,
        loaded: false,
        options: null,
    },
});

onBeforeMount(() => {
    // use axios to call each of the below endpoints
    axios.get(statBlocks['total-guests-attending'].endpoint).then((response) => {
        statBlocks['total-guests-attending'].data = response.data;
        statBlocks['total-guests-attending'].loaded = true;
    });

    axios.get(statBlocks['total-non-guests-attending'].endpoint).then((response) => {
        statBlocks['total-non-guests-attending'].data = response.data;
        statBlocks['total-non-guests-attending'].loaded = true;
    });

    axios.get(statBlocks['total-remaining-invites'].endpoint).then((response) => {
        statBlocks['total-remaining-invites'].data = response.data;
        statBlocks['total-remaining-invites'].loaded = true;
    });

    axios.get(statBlocks['total-remaining-rsvps'].endpoint).then((response) => {
        statBlocks['total-remaining-rsvps'].data = response.data;
        statBlocks['total-remaining-rsvps'].loaded = true;
    });

    axios.get(statBlocks['total-children-attending'].endpoint).then((response) => {
        statBlocks['total-children-attending'].data = response.data;
        statBlocks['total-children-attending'].loaded = true;
    });

    axios.get(statBlocks['rsvp-over-time'].endpoint).then((response) => {
        statBlocks['rsvp-over-time'].data = response.data;
        statBlocks['rsvp-over-time'].loaded = true;

        statBlocks['rsvp-over-time'].options = {
            chart: {
                id: 'rsvp-over-time',
                type: 'line',
                height: 350,
                toolbar: {
                    show: false,
                },
            },
            xaxis: {
                categories: response.data.invite_data_by_date.map((item) => item.date),
            },
            yaxis: {
                min: 0,
                max: response.data.total_invites_to_send,
                stepSize: 5,
                labels: {
                    formatter(value) {
                        return value.toFixed(0);
                    },
                },
            },
        };

        statBlocks['rsvp-over-time'].series = [
            {
                name: 'Invites Sent',
                data: response.data.invite_data_by_date.map((item) => item.invites_sent),
            },
            {
                name: 'RSVPs Returned',
                data: response.data.invite_data_by_date.map((item) => item.rsvps_returned),
            },
        ];
    });

    axios.get(statBlocks['attendance-ratio'].endpoint).then((response) => {
        statBlocks['attendance-ratio'].data = response.data;
        statBlocks['attendance-ratio'].loaded = true;
    });

    axios.get(statBlocks['alcohol-ratio'].endpoint).then((response) => {
        statBlocks['alcohol-ratio'].data = response.data;
        statBlocks['alcohol-ratio'].loaded = true;
    });

    axios.get(statBlocks['day-attendance-ratio'].endpoint).then((response) => {
        statBlocks['day-attendance-ratio'].data = response.data;
        statBlocks['day-attendance-ratio'].loaded = true;
    });

    axios.get(statBlocks['evening-attendance-ratio'].endpoint).then((response) => {
        statBlocks['evening-attendance-ratio'].data = response.data;
        statBlocks['evening-attendance-ratio'].loaded = true;
    });

    axios.get(statBlocks['plus-one-usage'].endpoint).then((response) => {
        statBlocks['plus-one-usage'].data = response.data;
        statBlocks['plus-one-usage'].loaded = true;
    });

    axios.get(statBlocks['not-yet-responded'].endpoint).then((response) => {
        statBlocks['not-yet-responded'].data = response.data;
        statBlocks['not-yet-responded'].loaded = true;
    });

    axios.get(statBlocks['not-attending'].endpoint).then((response) => {
        statBlocks['not-attending'].data = response.data;
        statBlocks['not-attending'].loaded = true;
    });
});
</script>
