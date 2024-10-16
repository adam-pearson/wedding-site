<template>
  <AdminAreaLayout>
    <div>
      <!--      <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">-->
      <!--        <div-->
      <!--          v-for="block in statBlocks"-->
      <!--          :key="block.title"-->
      <!--          class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"-->
      <!--        >-->
      <!--          <dt class="truncate text-sm font-medium text-gray-500">-->
      <!--            {{ block.title }}-->
      <!--          </dt>-->
      <!--          <dd-->
      <!--            class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"-->
      <!--            v-if="block.type === 'count'"-->
      <!--          >-->
      <!--            {{ block.data?.count }}-->
      <!--          </dd>-->
      <!--          <dd-->
      <!--            class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"-->
      <!--            v-else-if="block.type === 'line-chart'"-->
      <!--          >-->
      <!--            <apexchart-->
      <!--              width="100%"-->
      <!--              type="line"-->
      <!--              :options="block.options"-->
      <!--              :series="block.series"-->
      <!--              v-if="block.loaded"-->
      <!--            />-->
      <!--          </dd>-->
      <!--        </div>-->
      <!--      </dl>-->
      <GridLayout
        v-model:layout="layout"
        :col-num="12"
        :row-height="30"
        is-draggable
        is-resizable
        responsive

        vertical-compact
        use-css-transforms
      >
        <template
          #item="{ item }"
        >
          <Component
            :is="item.component"
          />
        </template>
      </GridLayout>
    </div>
  </AdminAreaLayout>
</template>

<script setup>
import axios from 'axios';
import {
    markRaw, onBeforeMount, reactive, ref,
} from 'vue';
import { GridLayout, GridItem } from 'grid-layout-plus';
import AdminAreaLayout from '../../shared/layouts/AdminAreaLayout.vue';
import TotalGuestsAttending from '../components/stat-blocks/TotalGuestsAttending.vue';
import TotalNonGuestsAttending from '../components/stat-blocks/TotalNonGuestsAttending.vue';
import TotalRemainingInvites from '../components/stat-blocks/TotalRemainingInvites.vue';
import TotalRemainingRsvps from '../components/stat-blocks/TotalRemainingRsvps.vue';
import TotalChildrenAttending from '../components/stat-blocks/TotalChildrenAttending.vue';
import RsvpsOverTime from '../components/stat-blocks/RsvpsOverTime.vue';
import AttendanceRatio from '../components/stat-blocks/AttendanceRatio.vue';
import AlcoholRatio from '../components/stat-blocks/AlcoholRatio.vue';
import DayAttendanceRatio from '../components/stat-blocks/DayAttendanceRatio.vue';
import EveningAttendanceRatio from '../components/stat-blocks/EveningAttendanceRatio.vue';
import PlusOneUsage from '../components/stat-blocks/PlusOneUsage.vue';
import NotYetResponded from '../components/stat-blocks/NotYetResponded.vue';
import NotAttending from '../components/stat-blocks/NotAttending.vue';

const layout = reactive([
    {
        i: '0',
        x: 0,
        y: 0,
        w: 2,
        h: 3,
        component: markRaw(TotalGuestsAttending),
    },
    {
        i: '1',
        x: 2,
        y: 0,
        w: 2,
        h: 3,
        component: markRaw(TotalNonGuestsAttending),
    },
    {
        i: '2',
        x: 4,
        y: 0,
        w: 2,
        h: 3,
        component: markRaw(TotalRemainingInvites),
    },
    {
        i: '3',
        x: 6,
        y: 0,
        w: 2,
        h: 3,
        component: markRaw(TotalRemainingRsvps),
    },
    // {
    //     i: '4',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(TotalChildrenAttending),
    // },
    {
        i: '5',
        x: 8,
        y: 0,
        w: 3,
        h: 8,
        minW: 3,
        minH: 8,
        preserveAspectRatio: true,
        component: markRaw(RsvpsOverTime),
        // maybe make these dynamic, have an array of components with width, height etc then also pass as props
        // this would let the internal component know what size it currently is, and let us scale text etc
    },
    // {
    //     i: '6',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(AttendanceRatio),
    // },
    // {
    //     i: '7',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(AlcoholRatio),
    // },
    // {
    //     i: '8',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(DayAttendanceRatio),
    // },
    // {
    //     i: '9',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(EveningAttendanceRatio),
    // },
    // {
    //     i: '10',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(PlusOneUsage),
    // },
    // {
    //     i: '11',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(NotYetResponded),
    // },
    // {
    //     i: '12',
    //     x: 0,
    //     y: 0,
    //     w: 2,
    //     h: 3,
    //     component: markRaw(NotAttending),
    // },
]);
</script>
