<template>
  <!-- eslint-disable max-len -->
  <div
    id="faq"
    class="flex w-full flex-col items-center justify-center gap-0 bg-offwhite-500 px-4 py-16 md:gap-4 md:py-16 lg:px-16 xl:px-32"
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
        <dl class="space-y-6 divide-y divide-gray-900/10">
          <Disclosure
            as="div"
            v-for="faq in faqs"
            :key="faq.question"
            class="pt-6"
            v-slot="{ open }"
          >
            <dt>
              <DisclosureButton class="flex w-full items-start justify-between text-left text-gray-900 transition-colors duration-300 hover:text-primary-500">
                <span class="text-sm font-semibold leading-7">{{ faq.question }}</span>
                <span class="ml-6 flex h-7 items-center">
                  <PlusSmallIcon
                    v-if="!open"
                    class="size-4"
                    aria-hidden="true"
                  />
                  <MinusSmallIcon
                    v-else
                    class="size-4"
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
                    duration: 200,
                  }
                } "
            >
              <p
                class="text-sm leading-7 text-gray-600"
              >
                {{ faq.answer }}
              </p>
              <a
                v-if="faq.supporting_url"
                class="hover: text-sm leading-7 text-primary-500 decoration-secondary-500 hover:underline"
                :href="faq.supporting_url"
                target="_blank"
                rel="noopener noreferrer"
              >
                {{ faq.supporting_url_text ?? 'Learn more' }}
              </a>
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
        question: 'What time should I arrive?',
        answer: 'The ceremony will begin at 13:00, so ideally guests may begin arriving from 12:00. We recommend arriving at least 30 minutes before the ceremony begins.',
    },
    {
        question: 'I\'ve been allocated a room at the venue - when do I pay?',
        answer: 'Guests who have been allocated a room at the venue should pay for their rooms upon check-in.',
    },
    {
        question: "What's the dress code for the wedding?",
        answer:
            'Our wedding will have a cocktail attire dress code. Gentlemen, please feel free to wear a suit or dress shirt. Ladies, a cocktail dress or dressy separates are great.',
    },
    {
        question: 'Can I RSVP to you directly?',
        answer:
            'If you prefer (or some of Adam\'s code broke and the RSVP form stopped working 😂), you can email us directly at heather.adam.wedding.2024@gmail.com, or send one of us a message on Facebook & we can sort out your RSVP that way.',
    },
    {
        question: 'What date are RSVPs due by?',
        answer: 'We\'d very much appreciate if everybody could RSVP by the 17th of November at the latest, so we can finalise numbers with our vendors.',
    },
    {
        question: "What's the address of the venue again?",
        answer: 'The venue address is Beeston Manor, Quaker Brook Ln, Preston PR5 0RA. The What3Words code is surprised.capillary.preparing',
        supporting_url: 'https://www.google.com/maps/place/Beeston+Manor+Events+Venue/@53.7452243,-2.6069377,15.75z/data=!4m10!3m9!1s0x487b7483b0b3419f:0x6d50208700baf14d!5m3!1s2024-11-10!4m1!1i2!8m2!3d53.7450103!4d-2.602025!16s%2Fg%2F12cpn4m1x?entry=ttu&g_ep=EgoyMDI0MDkxOC4xIKXMDSoASAFQAw%3D%3D',
        supporting_url_text: 'View on Google Maps',
    },
    {
        question: 'Is there parking at the venue?',
        answer: 'There should be plenty of parking available at the venue.',
    },
    {
        question: 'Am I allowed to bring a plus one?',
        answer: 'Unless stated explicitly on your invitation, we unfortunately can\'t accommodate plus ones.',
    },
    {
        question: 'Can I bring my children?',
        answer: 'We love your children, but besides our niece & nephews we\'ve decided to make our wedding an adults-only event. We appreciate your understanding.',
    },
    {
        question: 'What type of food will be served at your wedding?',
        answer: 'Following the ceremony, there will be canapés served during the drinks reception, followed by a three-course meal (before the speeches). In the evening we will have bacon or sausage butties with chips. Veg alternatives TBD.',
    },
    {
        question: 'What time will the reception go on until?',
        answer: 'Last orders are called at 12:00am, with entertainment finishing at 12:30am.',
    },
];
</script>
