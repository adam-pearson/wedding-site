<template>
  <!-- eslint-disable max-len -->
  <div class="space-y-4 border-b border-gray-900/10 pb-4">
    <h2 class="pt-4 text-lg">
      {{ guest.name }}
      <span
        v-if="guest?.plus_one_parent"
        class="text-sm"
      >
        (+1 of {{ guest.plus_one_parent?.name }})</span>
    </h2>
    <div>
      <div class="flex w-full flex-col gap-4">
        <div class="flex w-full items-start gap-4">
          <label
            for="name"
            class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
          >Name</label>
          <div class="w-full">
            <div
              class="block flex-1 border-0 bg-transparent px-2 text-sm text-gray-900 placeholder:text-gray-400 focus:ring-0"
            >
              <p>{{ guest.name }}</p>
            </div>
          </div>
        </div>

        <div class="flex w-full items-start gap-4">
          <label
            for="email"
            class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
          >Email</label>
          <div class="w-full">
            <div
              class="block flex-1 border-0 bg-transparent px-2 text-sm text-gray-900 placeholder:text-gray-400 focus:ring-0"
            >
              <p>{{ guest.email }}</p>
            </div>
          </div>
        </div>

        <div class="flex w-full items-start gap-4">
          <label
            for="phone"
            class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
          >Phone</label>
          <div class="w-full">
            <div
              class="block flex-1 border-0 bg-transparent px-2 text-sm text-gray-900 placeholder:text-gray-400 focus:ring-0"
            >
              <p>{{ guest.phone }}</p>
            </div>
          </div>
        </div>

        <div class="flex w-full items-start gap-4">
          <label
            for="address"
            class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
          >Address</label>
          <div class="w-full">
            <div
              class="block flex-1 border-0 bg-transparent px-2 text-sm text-gray-900 placeholder:text-gray-400 focus:ring-0"
            >
              {{ guest.address }}
            </div>
          </div>
        </div>

        <div class="flex w-full items-start gap-4">
          <label
            for="invite_sent_on"
            class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
          >Invite Sent On</label>
          <div class="w-full">
            <div
              class="block flex-1 border-0 bg-transparent px-2 text-sm text-gray-900 placeholder:text-gray-400 focus:ring-0"
            >
              <p>{{ guest.invite_sent_on ?? 'Invite Not Sent' }}</p>
            </div>
          </div>
        </div>

        <div class="flex w-full items-start gap-4">
          <label
            for="address"
            class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
          >Unique Code</label>
          <div class="w-full">
            <div
              class="block flex-1 border-0 bg-transparent px-2 text-sm text-gray-900 placeholder:text-gray-400 focus:ring-0"
            >
              {{ guest.unique_code }}
            </div>
          </div>
        </div>

        <div class="col-span-full sm:col-span-3">
          <div class="flex items-center justify-between">
            <span class="flex flex-grow flex-col">
              <span
                class="text-sm font-medium leading-6 text-gray-900"
              >Has Plus One
              </span>
              <span class="text-sm text-gray-500">This guest is allowed to bring one extra guest.
              </span>
            </span>
            <div
              disabled
              :class="[
                guest.plus_one_allowed
                  ? 'bg-gray-600'
                  : 'bg-gray-200',
                'relative inline-flex h-6 w-11 flex-shrink-0 rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
              ]"
            >
              <span class="sr-only">Plus one allowed?</span>
              <span
                :class="[
                  guest.plus_one_allowed
                    ? 'translate-x-5'
                    : 'translate-x-0',
                  'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                ]"
              >
                <span
                  :class="[
                    guest.plus_one_allowed
                      ? 'opacity-0 duration-100 ease-out'
                      : 'opacity-100 duration-200 ease-in',
                    'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                  ]"
                  aria-hidden="true"
                >
                  <svg
                    class="h-3 w-3 text-gray-400"
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
                    guest.plus_one_allowed
                      ? 'opacity-100 duration-200 ease-in'
                      : 'opacity-0 duration-100 ease-out',
                    'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                  ]"
                  aria-hidden="true"
                >
                  <svg
                    class="h-3 w-3 text-indigo-600"
                    fill="currentColor"
                    viewBox="0 0 12 12"
                  >
                    <path
                      d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                    />
                  </svg>
                </span>
              </span>
            </div>
          </div>
        </div>

        <div class="col-span-full sm:col-span-3">
          <div class="flex items-center justify-between">
            <span class="flex flex-grow flex-col">
              <span
                class="text-sm font-medium leading-6 text-gray-900"
              >Guest Is Child</span>
              <span class="text-sm text-gray-500">
                This guest is a child and will not require an
                adult meal.
              </span>
            </span>
            <div
              :class="[
                guest.is_child ? 'bg-gray-600' : 'bg-gray-200',
                'relative inline-flex h-6 w-11 flex-shrink-0  rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
              ]"
            >
              <span class="sr-only">Is Child</span>
              <span
                :class="[
                  guest.is_child
                    ? 'translate-x-5'
                    : 'translate-x-0',
                  'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                ]"
              >
                <span
                  :class="[
                    guest.is_child
                      ? 'opacity-0 duration-100 ease-out'
                      : 'opacity-100 duration-200 ease-in',
                    'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                  ]"
                  aria-hidden="true"
                >
                  <svg
                    class="h-3 w-3 text-gray-400"
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
                    guest.is_child
                      ? 'opacity-100 duration-200 ease-in'
                      : 'opacity-0 duration-100 ease-out',
                    'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                  ]"
                  aria-hidden="true"
                >
                  <svg
                    class="h-3 w-3 text-indigo-600"
                    fill="currentColor"
                    viewBox="0 0 12 12"
                  >
                    <path
                      d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                    />
                  </svg>
                </span>
              </span>
            </div>
          </div>
        </div>

        <div
          class="col-span-full flex flex-nowrap items-center justify-between sm:col-span-3"
        >
          <div class="w-1/2">
            <label class="text-base font-semibold text-gray-900">Guest Type</label>
            <p class="text-sm text-gray-500">
              Will this guest receive an all-day, or an evening
              invitation?
            </p>
          </div>
          <fieldset class="mt-4">
            <legend class="sr-only">
              Guest Type
            </legend>
            <div
              class="space-y-4 sm:items-center xl:flex xl:space-x-10 xl:space-y-0"
            >
              <div
                v-for="option in guestTypeOptions"
                :key="option.value"
                class="flex items-center"
              >
                <input
                  disabled
                  :id="option.value"
                  :checked="guest.guest_type === option.value"
                  name="notification-method"
                  type="radio"
                  class="h-4 w-4 border-gray-300 text-gray-600 focus:ring-gray-600"
                >
                <label
                  :for="option.value"
                  class="ml-3 block text-sm font-medium leading-6 text-gray-900"
                >{{ option.name }}</label>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
  </div>

  <div class="space-y-4 pb-4">
    <h2 class="pt-4 text-lg">
      Invite Details
    </h2>
    <div v-if="guest?.received_invite">
      <div>
        <div class="flex w-full flex-col gap-4">
          <div class="col-span-full sm:col-span-3">
            <div class="flex items-center justify-between">
              <span class="flex flex-grow flex-col">
                <span
                  class="text-sm font-medium leading-6 text-gray-900"
                >
                  Coming
                </span>
                <span class="text-sm text-gray-500">
                  Is this guest coming or not?
                </span>
              </span>
              <div
                :class="[
                  guest?.received_invite?.coming
                    ? 'bg-gray-600'
                    : 'bg-gray-200',
                  'relative inline-flex h-6 w-11 flex-shrink-0  rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                ]"
              >
                <span class="sr-only">Is this guest coming?</span>
                <span
                  :class="[
                    guest?.received_invite?.coming
                      ? 'translate-x-5'
                      : 'translate-x-0',
                    'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                  ]"
                >
                  <span
                    :class="[
                      guest?.received_invite?.coming
                        ? 'opacity-0 duration-100 ease-out'
                        : 'opacity-100 duration-200 ease-in',
                      'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                    ]"
                    aria-hidden="true"
                  >
                    <svg
                      class="h-3 w-3 text-gray-400"
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
                      guest?.received_invite?.coming
                        ? 'opacity-100 duration-200 ease-in'
                        : 'opacity-0 duration-100 ease-out',
                      'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                    ]"
                    aria-hidden="true"
                  >
                    <svg
                      class="h-3 w-3 text-indigo-600"
                      fill="currentColor"
                      viewBox="0 0 12 12"
                    >
                      <path
                        d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                      />
                    </svg>
                  </span>
                </span>
              </div>
            </div>
          </div>

          <div class="col-span-full sm:col-span-3">
            <div class="flex items-center justify-between">
              <span class="flex flex-grow flex-col">
                <span
                  class="text-sm font-medium leading-6 text-gray-900"
                >
                  Alcohol With Meal
                </span>
                <span class="text-sm text-gray-500">
                  Is this guest having alcohol with their
                  meal?
                </span>
              </span>
              <div
                :class="[
                  guest.alcohol
                    ? 'bg-gray-600'
                    : 'bg-gray-200',
                  'relative inline-flex h-6 w-11 flex-shrink-0  rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                ]"
              >
                <span class="sr-only">Alcohol With Meal</span>
                <span
                  :class="[
                    guest.alcohol
                      ? 'translate-x-5'
                      : 'translate-x-0',
                    'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                  ]"
                >
                  <span
                    :class="[
                      guest.alcohol
                        ? 'opacity-0 duration-100 ease-out'
                        : 'opacity-100 duration-200 ease-in',
                      'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                    ]"
                    aria-hidden="true"
                  >
                    <svg
                      class="h-3 w-3 text-gray-400"
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
                      guest.alcohol
                        ? 'opacity-100 duration-200 ease-in'
                        : 'opacity-0 duration-100 ease-out',
                      'absolute inset-0 flex h-full w-full items-center justify-center transition-opacity',
                    ]"
                    aria-hidden="true"
                  >
                    <svg
                      class="h-3 w-3 text-indigo-600"
                      fill="currentColor"
                      viewBox="0 0 12 12"
                    >
                      <path
                        d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                      />
                    </svg>
                  </span>
                </span>
              </div>
            </div>
          </div>

          <div class="flex w-full items-start gap-4">
            <label
              for="dietary_requirements"
              class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
            >Dietary Requirements</label>
            <div class="w-full">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600"
              >
                <p>
                  {{
                    guest.received_invite
                      .dietary_requirements
                  }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="text-center"
      v-else
    >
      This guest has not yet RSVP'd.
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

const guestTypeOptions = [
    { name: 'All Day', value: 'all_day' },
    { name: 'Evening Only', value: 'evening' },
];
</script>
