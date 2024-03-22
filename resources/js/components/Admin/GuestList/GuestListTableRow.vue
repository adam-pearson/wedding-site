<template>
  <!-- eslint-disable max-len -->
  <tr>
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
      {{ guest.invite_sent_on ?? 'N/A' }}
    </td>
    <td
      class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
    >
      {{ guestPlusOneStatus }}
    </td>
    <td
      class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
    >
      <StatusBadge
        :status="getInviteStatus(guest)"
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
        <EyeIcon class="size-4" />
        <span class="sr-only">
          View {{ guest.name }}
        </span>
      </button>
      <button
        @click="emit('rsvp', guest)"
        :disabled="hasAlreadyRsvpd"
        class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
        :class="hasAlreadyRsvpd ? 'opacity-50 cursor-not-allowed ' : ''"
      >
        <PaperAirplaneIcon class="size-4" />
        <span class="sr-only">
          RSVP on behalf of{{ guest.name }}
        </span>
      </button>
      <button
        @click="emit('delete', guest)"
        class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
      >
        <TrashIcon class="size-4" />
        <span class="sr-only">
          Delete {{ guest.name }}
        </span>
      </button>
    </td>
  </tr>
  <tr
    v-if="guest.plus_one_child"
    class="ml-40 bg-gray-50"
  >
    <td
      class=" whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
    >
      <div class="flex items-center gap-2">
        {{ guest.plus_one_child.name }} (Plus One of {{ guest.name }})
      </div>
    </td>
    <td
      class="whitespace-nowrap px-3 py-2 text-sm text-gray-500"
    >
      {{ getGuestType(guest.plus_one_child) }}
    </td>
    <td />
    <td />
    <td />
    <td />
    <td
      class="relative flex items-center justify-end gap-2 whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
    >
      <button
        @click="emit('view-plus-one', guest.plus_one_child)"
        class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
      >
        <EyeIcon class="size-4" />
        <span class="sr-only">
          View {{ guest.plus_one_child.name }}
        </span>
      </button>
      <button
        @click="emit('delete', guest.plus_one_child)"
        class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
      >
        <TrashIcon class="size-4" />
        <span class="sr-only">
          Delete {{ guest.plus_one_child.name }}
        </span>
      </button>
    </td>
  </tr>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { computed } from 'vue';
import {
    EyeIcon, PaperAirplaneIcon, TrashIcon, UsersIcon,
} from '@heroicons/vue/24/outline';
import StatusBadge from '../../Shared/StatusBadge.vue';
import useGuestList from '../../../composables/guestList';
import useGuest from '../../../composables/guest';
import STATUS_TYPES from '../../../constants/inviteStatus';

const { getGuestType } = useGuestList();
const { getInviteStatus } = useGuest();

const props = defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(['view', 'view-plus-one', 'rsvp', 'delete']);

const hasAlreadyRsvpd = computed(
    () => getInviteStatus(props.guest) === STATUS_TYPES.accepted.value
        || getInviteStatus(props.guest) === STATUS_TYPES.rejected.value,
);

const guestPlusOneStatus = computed(() => {
    if (props.guest.plus_one_child) {
        return 'Yes';
    }

    if (props.guest.plus_one_allowed) {
        if (!props.guest.received_invite && props.guest.plus_one_child) {
            return 'Chose Not To Use';
        }

        return 'No - Not Chosen Yet';
    }

    return 'No';
});

</script>
