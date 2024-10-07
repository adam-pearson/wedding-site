<template>
  <!-- eslint-disable max-len -->
  <GuestAreaLayout>
    <div class="flex w-full flex-col items-center justify-center gap-4 px-4 py-20">
      <div
        class="flex w-full flex-col items-center justify-center gap-4 "
        v-if="guest && guest.rsvp_response === null"
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
        <h2 class="text-center font-serif text-3xl">
          {{ guest.name }}
        </h2>
        <p class="text-center">
          This invitation is for {{ guest.guest_type === GUEST_TYPES.ALL_DAY.value ? 'our entire wedding day' : 'our evening reception' }}. Please RSVP below.
        </p>
        <div class="w-full md:w-3/4 xl:w-1/2">
          <RsvpForm @submit="handleSubmit" />
        </div>
      </div>
      <div
        v-else-if="remainingGuests.length > 0"
        class="flex flex-col md:w-3/4 xl:w-1/2"
        v-motion
        :initial="{opacity: 0}"
        :visible-once="
          {
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 800,
            }
          } "
      >
        <h1
          class="text-center font-serif text-2xl"
          v-motion
          :initial="{opacity: 0}"
          :visible-once="
            {
              opacity: 1,
              transition: {
                ease: 'easeInOut',
                duration: 1200,
              }
            } "
        >
          Welcome!
        </h1>
        <h2
          class="text-center font-serif text-xl"
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
          You may RSVP for any or all of the below guests:
        </h2>
        <ul
          role="list"
          class="mt-4 divide-y divide-gray-100 rounded-md shadow-lg"
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
          <li
            v-for="(member, index) in guestGroup"
            :key="member.id"
            class="group relative flex justify-between  gap-x-6 px-4 py-5 transition-colors duration-150 first:rounded-t-md last:rounded-b-md sm:px-6 lg:px-8"
            :class="member.rsvp_response === null ? 'hover:bg-gray-50' : 'bg-green-50'"
            v-motion
            :initial="{opacity: 0}"
            :visible-once="
              {
                opacity: 1,
                transition: {
                  ease: 'easeInOut',
                  duration: 1200,
                  delay: 200 + (index * 200),
                }
              } "
          >
            <div class="flex min-w-0 gap-x-4">
              <img
                class="size-12 flex-none rounded-full bg-gray-50"
                :src="getAvatar(member)"
                alt=""
              >
              <div class="flex min-w-0 flex-col justify-center">
                <p class="text-sm font-semibold leading-6 text-gray-900">
                  <button
                    @click="setGuest(member)"
                    :disabled="member.rsvp_response !== null"
                  >
                    <span class="absolute inset-x-0 -top-px bottom-0" />
                    {{ member.name }}
                  </button>
                </p>
                <p
                  class="mt-1 flex text-xs leading-5 text-gray-500"
                  v-if="member.email"
                >
                  <span
                    class="relative truncate"
                  >{{ member.email }}</span>
                </p>
              </div>
            </div>
            <div class="flex shrink-0 items-center justify-center gap-x-4">
              <p
                v-if="member.rsvp_response !== null"
                class="text-sm text-gray-500"
              >
                Submitted
              </p>
              <ChevronRightIcon
                v-if="member.rsvp_response === null"
                class="size-5 flex-none text-gray-400 group-hover:text-gray-500"
                aria-hidden="true"
              />
            </div>
          </li>
        </ul>
      </div>
      <div
        v-else
        class="flex w-full flex-col items-center justify-center gap-4"
      >
        <h2 class="text-center font-serif text-2xl">
          Thank you!
        </h2>
        <p class="text-center text-sm">
          You have successfully RSVP'd. If you would like to make any changes, please contact <a
            class="text-primary-400 underline-offset-2 hover:underline"
            href="mailto:heather.adam.wedding.2024@gmail.com"
          >Adam or Heather</a>.
        </p>
        <a
          :href="route('home')"
          class="rounded-md bg-primary-500 px-4 py-1.5 text-white transition duration-150 hover:bg-primary-600"
        >Return</a>
      </div>
    </div>
    <div
      v-if="guest && guestCount > 1"
      class="flex w-full items-center justify-center"
    >
      <button
        @click="handleReload"
        class="border border-transparent px-4 py-1.5 text-sm text-gray-700 transition duration-300 hover:border-gray-300"
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
        Back to List
      </button>
    </div>
  </GuestAreaLayout>
</template>
<script setup>
import { onMounted, computed, watch } from 'vue';
import { ChevronRightIcon } from '@heroicons/vue/20/solid';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { createAvatar } from '@dicebear/core';
import { initials } from '@dicebear/collection';
import GuestAreaLayout from '../../../shared/layouts/GuestAreaLayout.vue';
import useGuest from '../../../../shared/composables/guest';
import RsvpForm from '@/guest_facing/rsvp/form/components/RsvpForm.vue';
import GUEST_TYPES from '../../../../shared/constants/guestTypes';

const {
    guest, guestGroup, setGuest, unsetGuest, setGuestGroup,
} = useGuest();

const guestCount = guestGroup.value?.length ?? 1;

const props = defineProps({
    guests: {
        type: Object,
        required: true,
    },
});
setGuestGroup(props.guests);

const getAvatar = (member) => {
    const avatar = createAvatar(initials, {
        seed: member.name,
        width: 64,
        height: 64,
        scale: 75,
    });
    return `data:image/svg+xml,${encodeURIComponent(avatar)}`;
};

const remainingGuests = computed(() => guestGroup.value.filter((g) => g.rsvp_response === null));

onMounted(() => {
    if (props.guests.length === 1) {
        setGuest(props.guests[0]);
    }
});

watch(() => props.guests, (newVal) => {
    unsetGuest();
    setGuestGroup(newVal);
});
const handleSubmit = (formData) => {
    axios.post(route('guest.rsvp.submit', { guest: guest.value.unique_code }), formData)
        .then(() => {
            unsetGuest();
            router.reload({ only: ['guests'] });
        });
};

const handleReload = () => {
    unsetGuest();
};

</script>

<style lang="postcss" scoped>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.75s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
