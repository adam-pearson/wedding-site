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
          <div class="mx-auto size-36 overflow-hidden rounded-full">
            <img
              :src="person.imageUrl"
              alt=""
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
import { ref } from 'vue';

const people = [
    {
        name: 'Megan Kong',
        role: 'Maid of Honour',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Craig Pearson',
        role: 'Best Man',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Nahui Wilson',
        role: 'Bridesmaid',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Matthew Robinson',
        role: 'Groomsman',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Sarah Pearson',
        role: 'Bridesmaid',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Andrew Kong',
        role: 'Groomsman',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Suzanne Pearson',
        role: 'Bridesmaid',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Alexander Wilson',
        role: 'Groomsman',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
];
</script>
