<template>
  <!-- eslint-disable max-len -->
  <form
    v-if="true"
    @submit.prevent="submit"
  >
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
              <TextInput
                v-model="editForm.name"
                name="name"
                id="name"
              />
            </div>
          </div>

          <div class="flex w-full items-start gap-4">
            <label
              for="email"
              class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
            >Email</label>
            <div class="w-full">
              <TextInput
                v-model="editForm.email"
                name="email"
                id="email"
              />
            </div>
          </div>

          <div class="flex w-full items-start gap-4">
            <label
              for="phone"
              class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
            >Phone</label>
            <div class="w-full">
              <TextInput
                v-model="editForm.phone"
                name="phone"
                id="phone"
              />
            </div>
          </div>

          <div class="flex w-full items-start gap-4">
            <label
              for="address"
              class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
            >Address</label>
            <div class="w-full">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600"
              >
                <textarea
                  v-model="editForm.address"
                  id="address"
                  name="address"
                  rows="3"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
            </div>
          </div>

          <div class="flex w-full items-start gap-4">
            <label
              for="invite_sent_on"
              class="block w-[30%] text-sm font-medium leading-6 text-gray-900"
            >Invite Sent At</label>
            <div class="w-full">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600"
              >
                <input
                  v-model="editForm.invite_sent_on"
                  type="date"
                  name="invite_sent_on"
                  id="invite_sent_on"
                  class="block flex-1 border-0 bg-transparent px-2 py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                >
              </div>
            </div>
          </div>

          <div class="col-span-full sm:col-span-3">
            <SwitchGroup
              as="div"
              class="flex items-center justify-between"
            >
              <span class="flex flex-grow flex-col">
                <SwitchLabel
                  as="span"
                  class="text-sm font-medium leading-6 text-gray-900"
                  passive
                >Has Plus One</SwitchLabel>
                <SwitchDescription
                  as="span"
                  class="text-sm text-gray-500"
                >This guest is allowed to bring one extra
                  guest.</SwitchDescription>
              </span>
              <Switch
                v-model="editForm.plus_one_allowed"
                :class="[
                  editForm.plus_one_allowed
                    ? 'bg-indigo-600'
                    : 'bg-gray-200',
                  'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                ]"
              >
                <span class="sr-only">Use setting</span>
                <span
                  :class="[
                    editForm.plus_one_allowed
                      ? 'translate-x-5'
                      : 'translate-x-0',
                    'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                  ]"
                >
                  <span
                    :class="[
                      editForm.plus_one_allowed
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
                      editForm.plus_one_allowed
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
              </Switch>
            </SwitchGroup>
          </div>

          <div class="col-span-full sm:col-span-3">
            <SwitchGroup
              as="div"
              class="flex items-center justify-between"
            >
              <span class="flex flex-grow flex-col">
                <SwitchLabel
                  as="span"
                  class="text-sm font-medium leading-6 text-gray-900"
                  passive
                >Guest Is Child</SwitchLabel>
                <SwitchDescription
                  as="span"
                  class="text-sm text-gray-500"
                >This guest is a child and will not require
                  an adult meal.</SwitchDescription>
              </span>
              <Switch
                v-model="editForm.is_child"
                :class="[
                  editForm.is_child
                    ? 'bg-indigo-600'
                    : 'bg-gray-200',
                  'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                ]"
              >
                <span class="sr-only">Is Child</span>
                <span
                  :class="[
                    editForm.is_child
                      ? 'translate-x-5'
                      : 'translate-x-0',
                    'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                  ]"
                >
                  <span
                    :class="[
                      editForm.is_child
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
                      editForm.is_child
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
              </Switch>
            </SwitchGroup>
          </div>

          <div
            class="col-span-full flex flex-nowrap items-center justify-between sm:col-span-3"
          >
            <div class="w-1/2">
              <label class="text-base font-semibold text-gray-900">Guest Type</label>
              <p class="text-sm text-gray-500">
                Will this guest receive an all-day, or an
                evening invitation?
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
                    v-model="editForm.guest_type"
                    :id="option.value"
                    :checked="editForm.guest_type === option.value"
                    :value="option.value"
                    name="notification-method"
                    type="radio"
                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
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

    <div class="space-y-4 border-b border-gray-900/10 pb-4">
      <h2 class="pt-4 text-lg">
        Invite Details
      </h2>
      <div v-if="guest?.received_invite">
        <div>
          <div class="flex w-full flex-col gap-4">
            <div class="col-span-full sm:col-span-3">
              <SwitchGroup
                as="div"
                class="flex items-center justify-between"
              >
                <span class="flex flex-grow flex-col">
                  <SwitchLabel
                    as="span"
                    class="text-sm font-medium leading-6 text-gray-900"
                    passive
                  >Coming</SwitchLabel>
                  <SwitchDescription
                    as="span"
                    class="text-sm text-gray-500"
                  >Is this guest coming or
                    not?</SwitchDescription>
                </span>
                <Switch
                  v-model="editForm.coming"
                  :class="[
                    editForm.coming
                      ? 'bg-indigo-600'
                      : 'bg-gray-200',
                    'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                  ]"
                >
                  <span class="sr-only">Is this guest coming?</span>
                  <span
                    :class="[
                      editForm.coming
                        ? 'translate-x-5'
                        : 'translate-x-0',
                      'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                    ]"
                  >
                    <span
                      :class="[
                        editForm.coming
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
                        editForm.coming
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
                </Switch>
              </SwitchGroup>
            </div>

            <div class="col-span-full sm:col-span-3">
              <SwitchGroup
                as="div"
                class="flex items-center justify-between"
              >
                <span class="flex flex-grow flex-col">
                  <SwitchLabel
                    as="span"
                    class="text-sm font-medium leading-6 text-gray-900"
                    passive
                  >Alcohol With Meal</SwitchLabel>
                  <SwitchDescription
                    as="span"
                    class="text-sm text-gray-500"
                  >Is this guest having alcohol with their
                    meal?</SwitchDescription>
                </span>
                <Switch
                  v-model="editForm.alcohol"
                  :class="[
                    editForm.alcohol
                      ? 'bg-indigo-600'
                      : 'bg-gray-200',
                    'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                  ]"
                >
                  <span class="sr-only">Alcohol With Meal</span>
                  <span
                    :class="[
                      editForm.alcohol
                        ? 'translate-x-5'
                        : 'translate-x-0',
                      'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                    ]"
                  >
                    <span
                      :class="[
                        editForm.alcohol
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
                        editForm.alcohol
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
                </Switch>
              </SwitchGroup>
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
                  <textarea
                    v-model="editForm.dietary_requirements"
                    id="dietary_requirements"
                    name="dietary_requirements"
                    rows="3"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  />
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
  </form>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { reactive } from 'vue';
import {
    SwitchGroup,
    SwitchLabel,
    SwitchDescription,
    Switch,
} from '@headlessui/vue';
import useGuestList from '../../../composables/guestList';
import TextInput from '../../Shared/FormComponents/TextInput.vue';

const { updateGuest } = useGuestList();

const emit = defineEmits(['finished-editing']);

const props = defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

const guestTypeOptions = [
    { name: 'All Day', value: 'all_day' },
    { name: 'Evening Only', value: 'evening' },
];

const editForm = reactive({
    name: props.guest.name,
    email: props.guest.email,
    phone: props.guest.phone,
    address: props.guest.address,
    plus_one_allowed: Boolean(props.guest.plus_one_allowed),
    is_child: Boolean(props.guest.is_child),
    guest_type: props.guest.guest_type,
    invite_sent_on: props.guest.invite_sent_on,
    coming: Boolean(props.guest?.received_invite?.coming),
    alcohol: Boolean(props.guest?.received_invite?.alcohol),
    dietary_requirements: props.guest?.received_invite?.dietary_requirements,
});

console.log('editForm: ', editForm);

const submit = () => {
    updateGuest(props.guest.id, editForm);
    emit('finished-editing');
    /** @TODO - ENSURE FORM ALSO EDITS RECEIVED_INVITES TABLE */
    /** @TODO - ENSURE FORM EDITS MAIN GUEST IF PLUS ONE GUEST TYPE IS EDITED AND VICE VERSA */
};
</script>
