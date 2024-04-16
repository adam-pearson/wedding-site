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
            <div v-if="welcomeOpen">
              <RsvpInvite @close-invite="welcomeOpen = false" />
            </div>
            <div v-else-if="!welcomeOpen && !successOpen">
              <RsvpForm @submit="submit" />
            </div>
            <div v-else-if="successOpen">
              <RsvpSuccess />
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
import { ref } from 'vue';
import axios from 'axios';
import RsvpForm from './RsvpForm.vue';
import RsvpInvite from './RsvpInvite.vue';
import RsvpSuccess from './RsvpSuccess.vue';

const welcomeOpen = ref(true);
const successOpen = ref(false);

const submit = ($event) => {
    axios.post(route('guest.rsvp.submit', { guest: $event.guest_code }), $event.formData)
        .then((res) => {
            if (res.data.success) {
                successOpen.value = true;
            }
        });
};

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
