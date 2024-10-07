<template>
  <!-- eslint-disable max-len -->
  <div
    id="wedding-party"
    class="flex w-full flex-col items-center justify-center gap-0 bg-offwhite-500 px-4 py-16 md:gap-4 md:py-16 lg:px-16 xl:px-32 "
  >
    <h3
      class="text-center font-script text-4xl text-primary-500"
      v-motion
      :initial="{opacity: 0}"
      :visible-once="
        {
          opacity: 1,
          transition: {
            ease: 'easeInOut',
            duration: 800,
            delay: 200,
          }
        } "
    >
      Our Wedding Party
    </h3>
    <p
      class="w-full text-center font-serif text-gray-600 md:w-3/5"
      v-motion
      :initial="{opacity: 0}"
      :visible-once="
        {
          opacity: 1,
          transition: {
            ease: 'easeInOut',
            duration: 600,
            delay: 200,
          }
        } "
    >
      We'd like to introduce you to the people who will be standing by our side on our special day.
    </p>
    <div class="w-full">
      <ul
        role="list"
        class="mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-8 md:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 xl:grid-cols-4"
      >
        <li
          class="group"
          v-for="(person, index) in people"
          :key="person.id"
          v-motion
          :initial="{opacity: 0, y: 50}"
          :visible-once="
            {
              y: 0,
              opacity: 1,
              transition: {
                ease: 'easeInOut',
                duration: 600,
                delay: 100 + (index * 100),
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

function getImageUrl(name) {
    if (name === 'alexander') {
        return getAlexanderImage();
    }
    return `/images/${name}.webp`;
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
        id: 'megan',
        name: 'Megan Kong',
        role: 'Maid of Honour',
        imageUrl: getImageUrl('megan'),
    },
];

const bestMan = [
    {
        id: 'craig',
        name: 'Craig Pearson',
        role: 'Best Man',
        imageUrl: getImageUrl('craig'),
    },
];

const bridesmaids = [
    {
        id: 'nahui',
        name: 'Nahui Wilson',
        role: 'Bridesmaid',
        imageUrl: getImageUrl('nahui'),
    },
    {
        id: 'sarah',
        name: 'Sarah Pearson',
        role: 'Bridesmaid',
        imageUrl: getImageUrl('sarah'),
    },
    {
        id: 'suzanne',
        name: 'Suzanne Pearson',
        role: 'Bridesmaid',
        imageUrl: getImageUrl('suzanne'),
    },
];

const groomsmen = [
    {
        id: 'matthew',
        name: 'Matthew Robinson',
        role: 'Groomsman',
        imageUrl: getImageUrl('matthew'),
    },
    {
        id: 'andrew',
        name: 'Andrew Kong',
        role: 'Groomsman',
        imageUrl: getImageUrl('andrew'),
    },
    {
        id: 'alexander',
        name: 'Alexander Wilson',
        role: 'Groomsman',
        imageUrl: getImageUrl('alexander'),
    },
];

const people = computed(() => {
    const firstGroup = [...maidOfHonor, ...bestMan];

    const secondGroup = [...bridesmaids, ...groomsmen].sort(() => Math.random() - 0.5);
    return [...firstGroup, ...secondGroup];
});

</script>
