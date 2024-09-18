<template>
  <!--eslint-disable max-len-->
  <div
    id="welcome"
    class="welcome section-padding bg-offwhite-500"
  >
    <div
      class="px-4 py-16 text-center sm:p-16 md:py-32 xl:p-48 2xl:px-96"
    >
      <div class="flex w-full flex-col items-center justify-center gap-y-4">
        <h2
          class="pb-2 font-script text-4xl text-primary-500"
          v-motion
          :initial="{opacity: 0, y: -20}"
          :visible-once="
            {
              opacity: 1,
              y: 0,
              transition: {
                ease: 'easeInOut',
                duration: 800,
              }
            } "
        >
          Welcome!
        </h2>
        <div class="text-md flex flex-col gap-4 font-serif">
          <p
            v-motion
            :initial="{opacity: 0, y: 20}"
            :visible-once="
              {
                opacity: 1,
                y: 0,
                transition: {
                  ease: 'easeInOut',
                  duration: 800,
                  delay: 200,
                }
              } "
          >
            To our friends and family: We're so excited to celebrate our wedding with you.
          </p>

          <p
            v-motion
            :initial="{opacity: 0, y: 20}"
            :visible-once="
              {
                opacity: 1,
                y: 0,
                transition: {
                  ease: 'easeInOut',
                  duration: 800,
                  delay: 600,
                }
              } "
          >
            You can find all the details you need to know about our big day here, but if there is anything more you need to know, please feel free to send one of us a message.
          </p>
          <p
            v-motion
            :initial="{opacity: 0, y: 20}"
            :visible-once="
              {
                opacity: 1,
                y: 0,
                transition: {
                  ease: 'easeInOut',
                  duration: 800,
                  delay: 800,
                }
              } "
          >
            <em>Also, please remember that clocks go back on the 30th of March 2025!</em>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!--eslint-enable max-len-->
</template>

<script setup>

</script>
