<template>
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
        <EyeIcon class="size-4" />
        <span class="sr-only">
          View {{ guest.name }}
        </span>
      </button>
      <button
        @click="emit('rsvp', guest)"
        class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
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
</template>

<script setup>
import {
    EyeIcon, PaperAirplaneIcon, TrashIcon, UsersIcon,
} from '@heroicons/vue/24/outline';
import StatusBadge from '../../Shared/StatusBadge.vue';
import useGuestList from '../../../composables/guestList';

const { getGuestType } = useGuestList();

defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(['view', 'rsvp', 'delete']);

</script>
