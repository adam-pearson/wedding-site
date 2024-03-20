<template>
  <!-- eslint-disable max-len -->
  <div>
    <div class="flex w-full justify-center bg-white">
      <div class="flex w-full justify-center py-4 sm:px-6 lg:px-8">
        <div
          class="min-w-1/2 relative isolate flex size-full min-h-[750px] max-w-[650px] flex-col items-center justify-center gap-4 overflow-hidden bg-slate-50 px-6 py-16 text-center shadow-2xl sm:rounded-3xl sm:px-16"
        >
          <Transition
            appear
            mode="out-in"
          >
            <div
              v-if="welcomeOpen"
            >
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
                  @click="welcomeOpen = false"
                  class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                >
                  RSVP
                </button>
              </div>
            </div>
            <div v-else>
              <RsvpForm />
            </div>
          </Transition>
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
import { ref, computed } from 'vue';
import useGuest from '@/composables/guest';
import GUEST_TYPES from '../../constants/guestTypes';
import RsvpForm from './RsvpForm.vue';

const { guest } = useGuest();
const guestIsEvening = computed(() => guest.value.guest_type === GUEST_TYPES.EVENING.value);
const inviteTime = computed(() => (guestIsEvening.value ? '7 o\'clock' : '1 o\'clock'));
const inviteType = computed(() => (guestIsEvening.value ? 'Evening Reception' : 'Wedding Ceremony'));

const welcomeOpen = ref(true);

</script>

<style lang="postcss" scoped>
.v-enter-active,
.v-leave-active {
  transition: opacity 1.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
