<template>
    <!-- eslint-disable max-len -->

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                >
                    <div
                        class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg"
                    >
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                    >
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Guest Type
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Date Invite Sent
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Has Plus One
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Status
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Code
                                    </th>
                                    <th
                                        scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                    >
                                        <span class="sr-only">Edit</span>
                                    </th>
                                    <th
                                        scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                    >
                                        <span class="sr-only">RSVP</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="guest in guests" :key="guest.id">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                    >
                                        <div class="flex items-center gap-2">
                                            <UsersIcon
                                                class="h-4"
                                                v-if="guest.is_child"
                                            />
                                            {{ guest.name }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                    >
                                        {{ getGuestType(guest) }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                    >
                                        {{ guest.invite_sent_at ?? 'N/A' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                    >
                                        {{
                                            guest.plus_one_allowed
                                                ? 'Yes'
                                                : 'No'
                                        }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                    >
                                        <StatusBadge
                                            :status="
                                                guest.received_invite?.status ??
                                                'not_sent'
                                            "
                                        />
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                    >
                                        {{ guest.unique_code }}
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                    >
                                        <a
                                            href="#"
                                            class="text-indigo-600 hover:text-indigo-900"
                                            >Edit<span class="sr-only"
                                                >, {{ guest.name }}</span
                                            ></a
                                        >
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                    >
                                        <a
                                            href="#"
                                            class="text-indigo-600 hover:text-indigo-900"
                                            >RSVP<span class="sr-only"
                                                >, on behalf of
                                                {{ guest.name }}</span
                                            ></a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- eslint-enable max-len -->
</template>

<script setup>
import { UsersIcon } from '@heroicons/vue/24/outline';
import StatusBadge from '../../Shared/StatusBadge.vue';

const props = defineProps({
    guests: {
        type: Array,
        required: true,
    },
});

function getGuestType(guest) {
    switch (guest.guest_type) {
        case 'all_day':
            return 'All Day';
        case 'evening':
            return 'Evening';
        default:
            return 'Unknown';
    }
}

console.log('guests: ', props.guests);
const people = [
    {
        id: 1,
        name: 'Adam Pearson',
        type: 'All Day',
        date_sent: null,
        has_plus_one: true,
        status: 'accepted',
        code: 'A7F9D02',
        alcohol: true,
        dietary_requirements: null,
    },
];
</script>
