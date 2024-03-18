<template>
  <!-- eslint-disable max-len -->
  <form @submit.prevent="submit">
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <p class="font-serif text-2xl font-semibold text-primary-500">
          {{ guest.name }}
        </p>
        <h2 class="font-serif text-2xl font-semibold leading-7 text-primary-500">
          RSVP
        </h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">
          Please use the form below to RSVP to our wedding.
        </p>

        <div class="mt-10 flex flex-col items-center gap-8">
          <div class="flex w-full items-center justify-center gap-4">
            <div />
            <label
              for="coming"
              class="block w-1/2 text-sm font-medium leading-6 text-primary-500"
            >Are you coming?</label>
            <div class="w-1/2">
              <div class="col-span-full sm:col-span-3">
                <SwitchGroup
                  as="div"
                  class="flex items-center justify-between"
                >
                  <Switch
                    v-model="rsvpForm.coming.value"
                    :class="[
                      rsvpForm.coming.value
                        ? 'bg-indigo-600'
                        : 'bg-gray-200',
                      'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                    ]"
                  >
                    <span class="sr-only">Plus one allowed?</span>
                    <span
                      :class="[
                        rsvpForm.coming.value
                          ? 'translate-x-5'
                          : 'translate-x-0',
                        'pointer-events-none relative inline-block size-5 rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                      ]"
                    >
                      <span
                        :class="[
                          rsvpForm.coming.value
                            ? 'opacity-0 duration-100 ease-out'
                            : 'opacity-100 duration-200 ease-in',
                          'absolute inset-0 flex size-full items-center justify-center transition-opacity',
                        ]"
                        aria-hidden="true"
                      >
                        <svg
                          class="size-3 text-gray-400"
                          fill="none"
                          viewBox="0 0 12 12"
                        >
                          <path
                            d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </span>
                      <span
                        :class="[
                          rsvpForm.coming.value
                            ? 'opacity-100 duration-200 ease-in'
                            : 'opacity-0 duration-100 ease-out',
                          'absolute inset-0 flex size-full items-center justify-center transition-opacity',
                        ]"
                        aria-hidden="true"
                      >
                        <svg
                          class="size-3 text-indigo-600"
                          fill="currentColor"
                          viewBox="0 0 12 12"
                        >
                          <path
                            d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                          />
                        </svg>
                      </span>
                    </span>
                  </Switch>
                </SwitchGroup>
              </div>
            </div>
          </div>

          <div class="flex items-center justify-center gap-4">
            <label
              for="Email"
              class="block text-sm font-medium leading-6 text-white"
            >Email</label>
            <div class="w-1/2">
              <TextInput
                v-model="rsvpForm.email.value"
                :inverted="true"
                :disabled="!rsvpForm.email.editable"
                name="email"
                id="email"
                class="text-white"
              />
            </div>
          </div>

          <div class="flex items-center justify-center gap-4">
            <label
              for="Phone"
              class="block text-sm font-medium leading-6 text-white"
            >Phone</label>
            <div class="w-1/2">
              <TextInput
                v-model="rsvpForm.phone.value"
                :inverted="true"
                :disabled="!rsvpForm.phone.editable"
                name="phone"
                id="phone"
                class="text-white"
              />
            </div>
          </div>
        </div>

        <div class="border-b border-gray-900/10 pb-12">
          <h2 class="text-base font-semibold leading-7 text-gray-900">
            Personal Information
          </h2>
          <p class="mt-1 text-sm leading-6 text-gray-600">
            Use a permanent address where you can receive mail.
          </p>

          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label
                for="first-name"
                class="block text-sm font-medium leading-6 text-gray-900"
              >First name</label>
              <div class="mt-2">
                <input
                  type="text"
                  name="first-name"
                  id="first-name"
                  autocomplete="given-name"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
            </div>

            <div class="sm:col-span-3">
              <label
                for="last-name"
                class="block text-sm font-medium leading-6 text-gray-900"
              >Last name</label>
              <div class="mt-2">
                <input
                  type="text"
                  name="last-name"
                  id="last-name"
                  autocomplete="family-name"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
            </div>

            <div class="sm:col-span-4">
              <label
                for="email"
                class="block text-sm font-medium leading-6 text-gray-900"
              >Email address</label>
              <div class="mt-2">
                <input
                  id="email"
                  name="email"
                  type="email"
                  autocomplete="email"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
            </div>

            <div class="sm:col-span-3">
              <label
                for="country"
                class="block text-sm font-medium leading-6 text-gray-900"
              >Country</label>
              <div class="mt-2">
                <select
                  id="country"
                  name="country"
                  autocomplete="country-name"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                >
                  <option>United States</option>
                  <option>Canada</option>
                  <option>Mexico</option>
                </select>
              </div>
            </div>

            <div class="col-span-full">
              <label
                for="street-address"
                class="block text-sm font-medium leading-6 text-gray-900"
              >Street address</label>
              <div class="mt-2">
                <input
                  type="text"
                  name="street-address"
                  id="street-address"
                  autocomplete="street-address"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
            </div>

            <div class="sm:col-span-2 sm:col-start-1">
              <label
                for="city"
                class="block text-sm font-medium leading-6 text-gray-900"
              >City</label>
              <div class="mt-2">
                <input
                  type="text"
                  name="city"
                  id="city"
                  autocomplete="address-level2"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="region"
                class="block text-sm font-medium leading-6 text-gray-900"
              >State / Province</label>
              <div class="mt-2">
                <input
                  type="text"
                  name="region"
                  id="region"
                  autocomplete="address-level1"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="postal-code"
                class="block text-sm font-medium leading-6 text-gray-900"
              >ZIP / Postal code</label>
              <div class="mt-2">
                <input
                  type="text"
                  name="postal-code"
                  id="postal-code"
                  autocomplete="postal-code"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
            </div>
          </div>
        </div>

        <div class="border-b border-gray-900/10 pb-12">
          <h2 class="text-base font-semibold leading-7 text-gray-900">
            Notifications
          </h2>
          <p class="mt-1 text-sm leading-6 text-gray-600">
            We'll always let you know about important changes, but you pick what else you want to hear about.
          </p>

          <div class="mt-10 space-y-10">
            <fieldset>
              <legend class="text-sm font-semibold leading-6 text-gray-900">
                By Email
              </legend>
              <div class="mt-6 space-y-6">
                <div class="relative flex gap-x-3">
                  <div class="flex h-6 items-center">
                    <input
                      id="comments"
                      name="comments"
                      type="checkbox"
                      class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                    >
                  </div>
                  <div class="text-sm leading-6">
                    <label
                      for="comments"
                      class="font-medium text-gray-900"
                    >Comments</label>
                    <p class="text-gray-500">
                      Get notified when someones posts a comment on a posting.
                    </p>
                  </div>
                </div>
                <div class="relative flex gap-x-3">
                  <div class="flex h-6 items-center">
                    <input
                      id="candidates"
                      name="candidates"
                      type="checkbox"
                      class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                    >
                  </div>
                  <div class="text-sm leading-6">
                    <label
                      for="candidates"
                      class="font-medium text-gray-900"
                    >Candidates</label>
                    <p class="text-gray-500">
                      Get notified when a candidate applies for a job.
                    </p>
                  </div>
                </div>
                <div class="relative flex gap-x-3">
                  <div class="flex h-6 items-center">
                    <input
                      id="offers"
                      name="offers"
                      type="checkbox"
                      class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                    >
                  </div>
                  <div class="text-sm leading-6">
                    <label
                      for="offers"
                      class="font-medium text-gray-900"
                    >Offers</label>
                    <p class="text-gray-500">
                      Get notified when a candidate accepts or rejects an offer.
                    </p>
                  </div>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend class="text-sm font-semibold leading-6 text-gray-900">
                Push Notifications
              </legend>
              <p class="mt-1 text-sm leading-6 text-gray-600">
                These are delivered via SMS to your mobile phone.
              </p>
              <div class="mt-6 space-y-6">
                <div class="flex items-center gap-x-3">
                  <input
                    id="push-everything"
                    name="push-notifications"
                    type="radio"
                    class="size-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                  >
                  <label
                    for="push-everything"
                    class="block text-sm font-medium leading-6 text-gray-900"
                  >Everything</label>
                </div>
                <div class="flex items-center gap-x-3">
                  <input
                    id="push-email"
                    name="push-notifications"
                    type="radio"
                    class="size-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                  >
                  <label
                    for="push-email"
                    class="block text-sm font-medium leading-6 text-gray-900"
                  >Same as email</label>
                </div>
                <div class="flex items-center gap-x-3">
                  <input
                    id="push-nothing"
                    name="push-notifications"
                    type="radio"
                    class="size-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                  >
                  <label
                    for="push-nothing"
                    class="block text-sm font-medium leading-6 text-gray-900"
                  >No push notifications</label>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>

      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button
          type="button"
          class="text-sm font-semibold leading-6 text-gray-900"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Save
        </button>
      </div>
    </div>
  </form>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import {
    Switch, SwitchGroup, SwitchLabel, SwitchDescription,
} from '@headlessui/vue';
import axios from 'axios';
import { reactive } from 'vue';
import TextInput from '@/components/shared/FormComponents/TextInput.vue';
import useGuest from '../../composables/guest';

const { guest } = useGuest();

const rsvpForm = reactive({
    name: {
        value: guest.name,
        editable: false,
    },
    coming: {
        value: null,
        editable: true,
    },
    email: {
        value: guest.email,
        editable: true,
    },
    phone: {
        value: guest.phone,
        editable: true,
    },
    alcohol: {
        value: guest.is_child ? false : null,
        editable: !guest.is_child,
    },
    dietary_requirements: {
        value: guest.dietary_requirements,
        editable: true,
    },
    using_plus_one: {
        value: false,
        editable: guest.plus_one_allowed,
    },
    plus_one_name: {
        value: '',
        editable: true,
    },
    plus_one_alcohol: {
        value: null,
        editable: true,
    },
    plus_one_dietary_requirements: {
        value: '',
        editable: true,
    },
});

const submit = () => {
    console.log('submit');
    axios.post(`${route('rsvp.store')}/${guest.code}`, rsvpForm)
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        });
};

</script>
