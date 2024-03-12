<template>
  <!-- eslint-disable max-len -->
  <div>
    <div class="flex w-full items-center justify-center bg-white">
      <div class="w-full py-4 sm:px-6 lg:px-8">
        <div class="relative isolate flex flex-col gap-4 overflow-hidden bg-gray-900 px-6 py-16 text-center shadow-2xl sm:rounded-3xl sm:px-16">
          <h2 class="small-caps font-serif text-xl tracking-tight text-white">
            it is with great pleasure
          </h2>

          <div class="flex flex-col gap-2">
            <span class="my-1 block font-script text-4xl text-white sm:text-4xl lg:text-5xl">
              Heather & Adam
            </span>
            <div class="small-caps mb-2 flex flex-col font-serif text-lg text-white">
              <p>invite</p>
              <p class="text-4xl font-bold">
                {{ guest.name }}
              </p>
              <p>to join them for their</p>
            </div>
            <span class="my-1 block font-script text-4xl text-white sm:text-4xl lg:text-5xl">
              {{ inviteType }}
            </span>
            <span class="small-caps font-serif text-lg text-white">
              at Beeston Manor,<br>
              Quaker Brook Ln, Preston <span class="text-nowrap">PR5 0RA</span><br>
              Sunday the 30th of March, 2025<br>
              at {{ inviteTime }}
            </span>
          </div>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <button
              @click="emit('closed')"
              class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
            >
              RSVP
            </button>
          </div>
          <svg
            viewBox="0 0 1024 1024"
            class="absolute left-1/2 top-1/2 -z-10 size-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]"
            aria-hidden="true"
          >
            <circle
              cx="512"
              cy="512"
              r="512"
              fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)"
              fill-opacity="0.7"
            />
            <defs>
              <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
                <stop stop-color="#7775D6" />
                <stop
                  offset="1"
                  stop-color="#E935C1"
                />
              </radialGradient>
            </defs>
          </svg>
        </div>
      </div>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { computed } from 'vue';
import useGuest from '@/composables/guest';
import GUEST_TYPES from '../../constants/guestTypes';

const { guest } = useGuest();
const guestIsEvening = computed(() => guest.value.guest_type === GUEST_TYPES.EVENING.value);
const inviteTime = computed(() => (guestIsEvening.value ? '7 o\'clock' : '1 o\'clock'));
const inviteType = computed(() => (guestIsEvening.value ? 'Evening Reception' : 'Wedding Ceremony'));

const emit = defineEmits(['closed']);

</script>
