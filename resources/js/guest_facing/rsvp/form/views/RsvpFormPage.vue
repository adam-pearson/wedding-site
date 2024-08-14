<template>
  <!-- eslint-disable max-len -->
  <GuestAreaLayout>
    <div class="flex w-full flex-col items-center justify-center gap-4 px-4 py-20">
      <div
        class="flex w-full flex-col items-center justify-center gap-4 "
        v-if="guest && guest.rsvp_response === null"
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
        class="md:w-3/4 xl:w-1/2"
      >
        <h2 class="text-center font-serif text-xl">
          You may RSVP for any or all of the below guests:
        </h2>
        <ul
          role="list"
          class="divide-y divide-gray-100 pt-4"
        >
          <li
            v-for="member in guestGroup"
            :key="member.id"
            class="relative flex justify-between gap-x-6 px-4 py-5 sm:px-6 lg:px-8"
            :class="member.rsvp_response === null ? 'hover:bg-gray-50' : 'bg-green-50'"
          >
            <div class="flex min-w-0 gap-x-4">
              <img
                class="size-12 flex-none rounded-full bg-gray-50"
                :src="member.imageUrl"
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
                class="size-5 flex-none text-gray-400"
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
  </GuestAreaLayout>
</template>
<script setup>
import { onMounted, computed, watch } from 'vue';
import { ChevronRightIcon } from '@heroicons/vue/20/solid';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import GuestAreaLayout from '../../../shared/layouts/GuestAreaLayout.vue';
import useGuest from '../../../../shared/composables/guest';
import RsvpForm from '@/guest_facing/rsvp/form/components/RsvpForm.vue';
import GUEST_TYPES from '../../../../shared/constants/guestTypes';

const {
    guest, guestGroup, setGuest, unsetGuest, setGuestGroup,
} = useGuest();

const props = defineProps({
    guests: {
        type: Object,
        required: true,
    },
});
setGuestGroup(props.guests);

const remainingGuests = computed(() => guestGroup.value.filter((g) => g.rsvp_response === null));

// when a guest opens the form, if they're in a group they should see all group members
// if they're not in a group they should go directly to the form
// form should be visible whenever a guest is set in the composable
// whenever a guest submits the form, unset the guest in the composable
// reload the page when form is submitted/unset the guest in the composable
// we should then have a list of guests with up-to-date rsvp responses
// if they have already responded, we can grey them out
// once all guests have responded, we can show a message saying "all guests have responded"
// also add a message saying to contact us with any changes

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
