<template>
  <!-- eslint-disable max-len -->
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div
          class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
        >
          <div
            class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg"
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
                <GuestListTableRow
                  v-for="guest in guestList"
                  :key="guest.id"
                  :guest="guest"
                  @view="emit('view', guest)"
                  @view-plus-one="emit('view-plus-one', guest)"
                  @rsvp="emit('rsvp', guest)"
                  @delete="emit('delete', guest)"
                  @delete-plus-one="emit('delete-plus-one', guest.plus_one_child)"
                />
              </tbody>
              <tbody
                v-else
              >
                <tr>
                  <td colspan="6">
                    <div class="flex items-center justify-center py-8 text-center">
                      <div class="flex flex-col items-center justify-center">
                        <UserGroupIcon class="size-12 text-gray-400" />
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
import { UserGroupIcon } from '@heroicons/vue/24/outline';
import useGuestList from '../../../composables/guestList';
import LoadingOverlay from '../../Shared/LoadingOverlay.vue';
import GuestListTableRow from './GuestListTableRow.vue';

const { loading, guestList } = useGuestList();

const emit = defineEmits(['view', 'view-plus-one', 'rsvp', 'delete', 'delete-plus-one']);
</script>
