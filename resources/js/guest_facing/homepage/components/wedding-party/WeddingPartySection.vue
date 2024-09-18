<template>
  <!-- eslint-disable max-len -->
  <div
    id="wedding-party"
    class="flex w-full flex-col gap-0 px-4 py-16 md:flex-row md:gap-4 md:py-16 lg:px-32"
  >
    <div class="flex w-full flex-col ">
      <h3
        class="text-center font-script text-4xl text-primary-500"
        v-motion
        :initial="{opacity: 0}"
        :visible-once="
          {
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
              delay: 200,
            }
          } "
      >
        Our Wedding Party
      </h3>
      <ul
        role="list"
        class="mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-8 md:mt-16 md:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 xl:grid-cols-4"
      >
        <li
          class="group"
          v-for="(person, index) in people"
          :key="person.name"
          v-motion
          :initial="{opacity: 0, y: 50}"
          :visible-once="
            {
              y: 0,
              opacity: 1,
              transition: {
                ease: 'easeInOut',
                duration: 1200,
                delay: 200 + (index * 100),
              }
            } "
        >
          <div class="mx-auto size-36 overflow-hidden rounded-2xl shadow-md transition duration-300 group-hover:scale-105">
            <img
              :src="person.imageUrl ?? getRandomisedAvatar()"
              :alt="`${person.role} - ${person.name}`"
            >
          </div>

          <h3 class="mt-6 text-center font-serif text-lg font-semibold leading-7 tracking-tight text-gray-900">
            {{ person.name }}
          </h3>
          <p class="text-center text-sm leading-6 text-gray-600">
            {{ person.role }}
          </p>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { createAvatar } from '@dicebear/core';
import { lorelei } from '@dicebear/collection';

function getAlexanderImage() {
    return Math.floor(Math.random() * 100) === 0
        ? '/images/alexander_alt.webp'
        : '/images/alexander.webp';
}

const getRandomisedAvatar = () => {
    const randomColor = Math.floor(Math.random() * 16777215).toString(16);

    const avatar = createAvatar(lorelei, {
        seed: Math.floor(Math.random() * 16777215).toString(16),
        width: 300,
        height: 300,
        scale: 125,
        backgroundColor: [randomColor],
        backgroundType: ['gradientLinear', 'solid'],
    });
    return `data:image/svg+xml,${encodeURIComponent(avatar)}`;
};

const maidOfHonor = [

    {
        name: 'Megan Kong',
        role: 'Maid of Honour',
        imageUrl: null,
    },
];

const bestMan = [
    {
        name: 'Craig Pearson',
        role: 'Best Man',
        imageUrl: '/images/craig.webp',
    },
];

const bridesmaids = [
    {
        name: 'Nahui Wilson',
        role: 'Bridesmaid',
        imageUrl: '/images/nahui.webp',
    },
    {
        name: 'Sarah Pearson',
        role: 'Bridesmaid',
        imageUrl: '/images/sarah.webp',
    },
    {
        name: 'Suzanne Pearson',
        role: 'Bridesmaid',
        imageUrl: '/images/suzanne.webp',
    },
];

const groomsmen = [
    {
        name: 'Matthew Robinson',
        role: 'Groomsman',
        imageUrl: '/images/matthew.webp',
    },
    {
        name: 'Andrew Kong',
        role: 'Groomsman',
        imageUrl: null,
    },
    {
        name: 'Alexander Wilson',
        role: 'Groomsman',
        imageUrl: getAlexanderImage(),
    },
];

const people = computed(() => {
    const firstGroup = [...maidOfHonor, ...bestMan];

    // combine bridesmaids and groomsmen, randomise order, then combine with maid of honor and best man
    // this is to keep the MOH and BM in the first positions, then everyone else in a randomised spot
    const secondGroup = [...bridesmaids, ...groomsmen].sort(() => Math.random() - 0.5);
    return [...firstGroup, ...secondGroup];
});

</script>
