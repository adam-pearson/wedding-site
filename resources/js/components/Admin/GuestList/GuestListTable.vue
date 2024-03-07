<template>
  <!-- eslint-disable max-len -->
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div
          class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
        >
          <div
            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg relative"
          >
            <LoadingOverlay v-if="loading" />
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
                    <span class="sr-only">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody
                v-if="guestList.length"
                class="divide-y divide-gray-200 bg-white"
              >
                <tr
                  v-for="guest in guestList"
                  :key="guest.id"
                >
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
                    class="relative flex items-center justify-end gap-2 whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                  >
                    <button
                      @click="emit('view', guest)"
                      class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
                    >
                      <EyeIcon class="h-4 w-4" />
                      <span class="sr-only">
                        View {{ guest.name }}
                      </span>
                    </button>
                    <button
                      @click="emit('rsvp', guest)"
                      class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
                    >
                      <PaperAirplaneIcon class="h-4 w-4" />
                      <span class="sr-only">
                        RSVP on behalf of{{ guest.name }}
                      </span>
                    </button>
                    <button
                      @click="emit('delete', guest)"
                      class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
                    >
                      <TrashIcon class="h-4 w-4" />
                      <span class="sr-only">
                        Delete {{ guest.name }}
                      </span>
                    </button>
                  </td>
                </tr>
              </tbody>
              <tbody
                v-else
              >
                <tr>
                  <td colspan="6">
                    <div class="text-center flex items-center justify-center py-8">
                      <div class="flex flex-col justify-center items-center">
                        <UserGroupIcon class="h-12 w-12 text-gray-400" />
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">
                          No Guests
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                          Add a guest to get started
                        </p>
                      </div>
                    </div>
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
import {
    EyeIcon, PaperAirplaneIcon, TrashIcon, UserGroupIcon, UsersIcon,
} from '@heroicons/vue/24/outline';
import StatusBadge from '../../Shared/StatusBadge.vue';
import useGuestList from '../../../composables/guestList';
import LoadingOverlay from '../../Shared/LoadingOverlay.vue';

const { loading, guestList, getGuestType } = useGuestList();

const emit = defineEmits(['view', 'rsvp', 'delete']);
</script>
