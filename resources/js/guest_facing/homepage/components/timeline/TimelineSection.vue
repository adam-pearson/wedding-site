<template>
  <!-- eslint-disable max-len -->
  <div
    id="timeline"
    class="flex w-full flex-col items-center justify-center gap-0 bg-white px-4 py-16 md:gap-4 md:py-16 lg:px-16 xl:px-32"
  >
    <div class="group relative flex min-h-80 w-full flex-col divide-x-0 divide-y divide-secondary-600/30 bg-[url(/resources/assets/heroImageAlt_small.webp)] bg-cover bg-center bg-no-repeat shadow-md lg:flex-row lg:divide-x lg:divide-y-0">
      <div
        v-for="(event, index) in timelineEvents"
        :key="event.name"
        class="group/event z-10 flex w-full flex-col justify-center gap-4 bg-white p-4 transition duration-300 hover:bg-transparent"
      >
        <span class="font-serif text-[3rem] font-semibold text-secondary-600">{{ formatStepNumber(index) }}</span>
        <span class="font-sans text-xl font-semibold text-primary-500 transition  duration-300 group-hover/event:text-white">{{ event.time }}</span>
        <div class="flex flex-col gap-1">
          <span class="font-sans text-lg font-medium text-gray-700 transition  duration-300 group-hover/event:text-white">{{ event.name }}</span>
          <span class="font-sans text-sm text-gray-700 transition duration-300 group-hover/event:text-white">{{ event.description }}</span>
        </div>
      </div>
      <div class="absolute z-0 size-full bg-none backdrop-saturate-0" />
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>
<script setup>

const formatStepNumber = (index) => (index + 1).toString().padStart(2, '0');

const timelineEvents = [
    {
        time: '13:00',
        name: 'Ceremony Commences',
        description: 'The ceremony will begin, the couple will exchange vows & sign the register.',
    },
    {
        time: '13:30',
        name: 'Drinks Reception',
        description: 'Guests are invited to join the couple for a drinks reception, with canapés and drinks served.',
    },
    {
        time: '15:00',
        name: 'Wedding Breakfast',
        description: 'Everybody will be seated for the wedding breakfast, which will be served shortly after.',
    },
    {
        time: '17:00',
        name: 'Speeches',
        description: 'A number of speeches will be made by the couple and their family and friends.',
    },
    {
        time: '18:00',
        name: 'Evening Reception',
        description: 'Guests are invited to join the couple for an evening of dancing and celebration.',
    },
];
</script>

<style lang="postcss" scoped>

</style>
