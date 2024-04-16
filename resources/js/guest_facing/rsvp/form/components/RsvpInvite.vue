<template>
  <!-- eslint-disable max-len -->
  <div>
    <h2 class="small-caps font-serif text-xl tracking-tight text-black">
      it is with great pleasure
    </h2>

    <div class="flex flex-col gap-2">
      <span class="my-1 block font-script text-4xl text-black sm:text-4xl lg:text-5xl">
        Heather & Adam
      </span>
      <div class="small-caps mb-2 flex flex-col font-serif text-lg text-black">
        <p>invite</p>
        <p class="text-4xl font-bold">
          {{ guest.name }}
        </p>
        <p>to join them for their</p>
      </div>
      <span class="my-1 block font-script text-4xl text-black sm:text-4xl lg:text-5xl">
        {{ inviteType }}
      </span>
      <span class="small-caps font-serif text-lg text-black">
        at Beeston Manor,<br>
        Quaker Brook Ln, Preston <span class="text-nowrap">PR5 0RA</span><br>
        Sunday the 30th of March, 2025<br>
        at {{ inviteTime }}
      </span>
    </div>
    <div class="mt-10 flex items-center justify-center gap-x-6">
      <button
        @click="emit('closeInvite')"
        class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
      >
        RSVP
      </button>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { computed } from 'vue';
import useGuest from '../../../../shared/composables/guest';
import GUEST_TYPES from '../../../../shared/constants/guestTypes';

const { guest } = useGuest();

const emit = defineEmits(['closeInvite']);

const guestIsEvening = computed(() => guest.value.guest_type === GUEST_TYPES.EVENING.value);
const inviteTime = computed(() => (guestIsEvening.value ? '7 o\'clock' : '1 o\'clock'));
const inviteType = computed(() => (guestIsEvening.value ? 'Evening Reception' : 'Wedding Ceremony'));

</script>
