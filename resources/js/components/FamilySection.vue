<template>
    <div id="countdown" class="py-[100px] text-center bg-red-500">
        <div>
            <div>
                <div class="mb-4">
                    <h4 class="text-white font-script text-6xl">We will become a family<span v-if="!weddingHasStarted"> in</span></h4> 
                </div>
            </div>
            <div>
                <div v-if="!weddingHasStarted" class="countdown-time">
                    <ul>
                        <li><span id="days">{{ timeRemaining?.days }}</span>Days</li>
                        <li><span id="hours">{{ timeRemaining?.hours }}</span>Hours</li>
                        <li><span id="minutes">{{ timeRemaining?.minutes }}</span>Minutes</li>
                        <li><span id="seconds">{{ timeRemaining?.seconds }}</span>Seconds</li>
                    </ul>
                </div>
                <div v-else class="countdown-time">
                    <h4 class="text-white font-script text-6xl">Today!</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onBeforeMount, reactive, ref } from 'vue';

const WEDDING_DATE = 'Oct 02, 2024, 10:37:00';

const weddingHasStarted = ref(false);

const timeRemaining = reactive({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
})

onBeforeMount(() => {
    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;
    
    const endTime = new Date(WEDDING_DATE).getTime();

    const timingInterval = setInterval(() => {
        const now = new Date().getTime();
        const distance = endTime - now;
        

        if (distance < 0) {
            weddingHasStarted.value = true;

            console.log('WEDDING TIME!');
            clearInterval(timingInterval);
        }
        
        timeRemaining.days = Math.floor(distance / day);
        timeRemaining.hours = Math.floor((distance % (day)) / hour);
        timeRemaining.minutes = Math.floor((distance % (hour)) / minute);
        timeRemaining.seconds = Math.floor((distance % (minute)) / second);
    }, 0)
});

</script>

<style scoped lang="postcss">
.countdown-time span{
    @apply font-sans;
    @apply text-6xl;
    @apply block;
    @apply font-bold;
}

.countdown-time li {
    @apply inline-block;
    @apply text-white;
    @apply p-4;
    @apply leading-['3rem'];
    @apply uppercase;
    @apply tracking-wider;
}
</style>