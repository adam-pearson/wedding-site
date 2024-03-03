<template>
    <form class="px-0 pt-8 sm:px-6 lg:px-8" @submit.prevent="submit">
        <!-- eslint-disable max-len -->

        <div class="bg-white px-4 py-4">
            <div class="space-y-8">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                        Guest Information
                    </h2>

                    <div
                        class="mt-10 grid grid-cols-1 gap-y-8 sm:grid-cols-6 sm:gap-x-6"
                    >
                        <div class="col-span-full sm:col-span-3">
                            <label
                                for="first-name"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Name</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <label
                                for="email"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Email address</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="form.email"
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="col-span-full sm:col-span-3">
                            <label
                                for="email"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Phone</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="form.phone"
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    autocomplete="tel"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="col-span-3 col-span-full">
                            <label
                                for="address"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Address</label
                            >
                            <div class="mt-2">
                                <textarea
                                    v-model="form.address"
                                    name="address"
                                    id="address"
                                    autocomplete="address"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
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
                                        >Has Plus One</SwitchLabel
                                    >
                                    <SwitchDescription
                                        as="span"
                                        class="text-sm text-gray-500"
                                        >This guest is allowed to bring one
                                        extra guest.</SwitchDescription
                                    >
                                </span>
                                <Switch
                                    v-model="form.plus_one_allowed"
                                    :class="[
                                        form.plus_one_allowed
                                            ? 'bg-indigo-600'
                                            : 'bg-gray-200',
                                        'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                                    ]"
                                >
                                    <span class="sr-only">Use setting</span>
                                    <span
                                        :class="[
                                            form.plus_one_allowed
                                                ? 'translate-x-5'
                                                : 'translate-x-0',
                                            'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                                        ]"
                                    >
                                        <span
                                            :class="[
                                                form.plus_one_allowed
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
                                                form.plus_one_allowed
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
                            class="col-span-full flex flex-col justify-between sm:col-span-3 sm:flex-row"
                        >
                            <div class="w-full sm:w-[40%]">
                                <label
                                    class="text-base font-semibold text-gray-900"
                                    >Guest Type</label
                                >
                                <p class="text-sm text-gray-500">
                                    Will this guest receive an all-day, or an
                                    evening invitation?
                                </p>
                            </div>
                            <fieldset class="mt-4">
                                <legend class="sr-only">Guest Type</legend>
                                <div
                                    class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0"
                                >
                                    <div
                                        v-for="option in guestTypeOptions"
                                        :key="option.value"
                                        class="flex items-center"
                                    >
                                        <input
                                            v-model="form.guest_type"
                                            :id="option.value"
                                            :value="option.value"
                                            name="notification-method"
                                            type="radio"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                        />
                                        <label
                                            :for="option.value"
                                            class="ml-3 block text-sm font-medium leading-6 text-gray-900"
                                            >{{ option.name }}</label
                                        >
                                    </div>
                                </div>
                            </fieldset>
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
                                        >Guest Is Child</SwitchLabel
                                    >
                                    <SwitchDescription
                                        as="span"
                                        class="text-sm text-gray-500"
                                        >This guest is a child and will not
                                        require an adult
                                        meal.</SwitchDescription
                                    >
                                </span>
                                <Switch
                                    v-model="form.is_child"
                                    :class="[
                                        form.is_child
                                            ? 'bg-indigo-600'
                                            : 'bg-gray-200',
                                        'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                                    ]"
                                >
                                    <span class="sr-only">Is Child</span>
                                    <span
                                        :class="[
                                            form.is_child
                                                ? 'translate-x-5'
                                                : 'translate-x-0',
                                            'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                                        ]"
                                    >
                                        <span
                                            :class="[
                                                form.is_child
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
                                                form.is_child
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
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button
                    type="button"
                    class="text-sm font-semibold leading-6 text-gray-900"
                    @click="emit('closeForm')"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Add Guest
                </button>
            </div>
        </div>
        <!-- eslint-enable max-len -->
    </form>
</template>

<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from '@headlessui/vue';
import useGuestList from '../../../composables/guestList';

const guestTypeOptions = [
    { name: 'All Day', value: 'all_day', checked: true },
    { name: 'Evening Only', value: 'evening', checked: false },
];

const { saveNewGuest } = useGuestList();

const emit = defineEmits(['closeForm', 'submitted']);

const form = reactive({
    name: null,
    email: null,
    phone: null,
    address: null,
    plus_one_allowed: false,
    is_child: false,
    guest_type: guestTypeOptions[0].value,
});

const submit = () => {
    saveNewGuest(form).then(() => {
        emit('closeForm');
    });
};
</script>
