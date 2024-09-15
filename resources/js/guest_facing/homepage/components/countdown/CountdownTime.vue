<template>
  <div class="countdown-time">
    <ul>
      <li
        v-motion
        :initial="{opacity: 0, y: 50}"
        :visible-once="
          {
            y: 0,
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
              delay: 200,
            }
          } "
      >
        <span id="days">{{ timeRemaining?.days }}</span>Days
      </li>
      <li
        v-motion
        :initial="{opacity: 0, y: 50}"
        :visible-once="
          {
            y: 0,
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
              delay: 400,
            }
          } "
      >
        <span id="hours">{{ timeRemaining?.hours }}</span>Hours
      </li>
      <li
        v-motion
        :initial="{opacity: 0, y: 50}"
        :visible-once="
          {
            y: 0,
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
              delay: 600,
            }
          } "
      >
        <span id="minutes">{{ timeRemaining?.minutes }}</span>Minutes
      </li>
      <li
        v-motion
        :initial="{opacity: 0, y: 50}"
        :visible-once="
          {
            y: 0,
            opacity: 1,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
              delay: 800,
            }
          } "
      >
        <span id="seconds">{{ timeRemaining?.seconds }}</span>Seconds
      </li>
    </ul>
  </div>
</template>
<script setup>
import { onBeforeUnmount, reactive } from 'vue';
import useWeddingDateHelper from '../../../../shared/composables/weddingDateHelper';

const emit = defineEmits(['weddingStarted']);

const { WEDDING_DATE } = useWeddingDateHelper();

const timeRemaining = reactive({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
});

const second = 1000;
const minute = second * 60;
const hour = minute * 60;
const day = hour * 24;

const endTime = new Date(WEDDING_DATE).getTime();

const timingInterval = setInterval(() => {
    const now = new Date().getTime();
    const distance = endTime - now;

    if (distance < 0) {
        emit('weddingStarted');

        clearInterval(timingInterval);
    }

    timeRemaining.days = Math.floor(distance / day);
    timeRemaining.hours = Math.floor((distance % day) / hour);
    timeRemaining.minutes = Math.floor((distance % hour) / minute);
    timeRemaining.seconds = Math.floor((distance % minute) / second);
}, 0);

onBeforeUnmount(() => {
    clearInterval(timingInterval);
});
</script>

<style lang="postcss" scoped>
.countdown-time span {
    @apply font-sans;
    @apply text-6xl;
    @apply block;
    @apply font-bold;
    @apply drop-shadow-lg;
}

.countdown-time li {
    @apply inline-block;
    @apply text-white;
    @apply px-4;
    @apply md:p-4;
    @apply leading-['3rem'];
    @apply uppercase;
    @apply tracking-wider;
    @apply text-xs;
    @apply md:text-base;
    @apply drop-shadow-lg;
}
</style>
