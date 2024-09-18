<template>
  <!-- eslint-disable max-len -->
  <div
    id="faq"
    class="flex w-full flex-col items-center justify-center gap-0 bg-offwhite-500 px-4 py-16 md:gap-4 md:py-16 lg:px-32 "
  >
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
      Frequently Asked Questions
    </h3>
    <p
      class="w-3/5 text-center font-serif text-gray-600"
      v-motion
      :initial="{opacity: 0}"
      :visible-once="
        {
          opacity: 1,
          transition: {
            ease: 'easeInOut',
            duration: 1200,
            delay: 400,
          }
        } "
    >
      Here are some of the most common questions we've been asked. If you have a question that isn't answered here, please feel free to reach out to us.
    </p>
    <div
      class="w-full"
      v-motion
      :initial="{opacity: 0, y: 50}"
      :visible-once="
        {
          opacity: 1,
          y: 0,
          transition: {
            ease: 'easeInOut',
            duration: 1200,
            delay: 400,
          }
        } "
    >
      <div class="w-full divide-y divide-gray-900/10">
        <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
          <Disclosure
            as="div"
            v-for="faq in faqs"
            :key="faq.question"
            class="pt-6"
            v-slot="{ open }"
          >
            <dt>
              <DisclosureButton class="flex w-full items-start justify-between text-left text-gray-900">
                <span class="text-base font-semibold leading-7">{{ faq.question }}</span>
                <span class="ml-6 flex h-7 items-center">
                  <PlusSmallIcon
                    v-if="!open"
                    class="size-6"
                    aria-hidden="true"
                  />
                  <MinusSmallIcon
                    v-else
                    class="size-6"
                    aria-hidden="true"
                  />
                </span>
              </DisclosureButton>
            </dt>
            <DisclosurePanel
              as="dd"
              class="mt-2 pr-12"
              v-motion
              :initial="{opacity: 0}"
              :visible-once="
                {
                  opacity: 1,
                  transition: {
                    ease: 'easeInOut',
                    duration: 600,
                  }
                } "
            >
              <p
                class="text-base leading-7 text-gray-600"
              >
                {{ faq.answer }}
              </p>
            </DisclosurePanel>
          </Disclosure>
        </dl>
      </div>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';
import { MinusSmallIcon, PlusSmallIcon } from '@heroicons/vue/24/outline';

const faqs = [
    {
        question: "What's the best thing about Switzerland?",
        answer:
            "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer:
            "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the next best thing about Switzerland?",
        answer: 'The chocolate. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.',
    },
    {
        question: "What's the next best thing about Switzerland?",
        answer: 'The chocolate. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.',
    },
];
</script>
