<template>
  <AdminAreaLayout>
    <GuestDetailsModal
      v-if="detailsModalOpen && selectedGuest"
      :open="detailsModalOpen"
      :open-to-plus-one="openDetailsToPlusOne"
      @close="closeDetailsModal"
      :guest="selectedGuest"
    />
    <GuestDeleteConfirmation
      v-if="deletingGuestModalOpen && deletingGuest"
      :open="deletingGuestModalOpen"
      @close="closeDeleteConfirmation"
      :guest="deletingGuest"
    />
    <GuestListHeader
      @open-add-guest-form="toggleForm"
      :form-open="addGuestFormOpen"
    />
    <div
      v-for="row in stats"
      :key="row.id"
      class="px-6"
    >
      <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-5">
        <div
          v-for="item in row.stats"
          :key="item.name"
          class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
        >
          <dt class="truncate text-sm font-medium text-gray-500">
            {{ item.name }}
          </dt>
          <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
            {{ item.stat }}
          </dd>
        </div>
      </dl>
    </div>
    <Transition>
      <AddGuestForm
        v-if="addGuestFormOpen"
        @close-form="toggleForm"
        @submitted="reloadGuestList"
      />
    </Transition>
    <GuestListTable
      @view="openDetailsModal"
      @view-plus-one="openDetailsModalToPlusOne"
      @delete="openDeleteConfirmation"
      @delete-plus-one="openDeleteConfirmation"
      @rsvp="goToGuestRsvpForm"
      class="py-4"
    />
  </AdminAreaLayout>
</template>
<script setup>
import { ref, reactive, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import GuestDetailsModal from '../components/guest-details/GuestDetailsModal.vue';
import GuestListHeader from '../components/header/GuestListHeader.vue';
import AddGuestForm from '../components/add-guest-form/AddGuestForm.vue';
import GuestListTable from '../components/guest-list-table/GuestListTable.vue';
import useGuestList from '../composables/guestList';
import GuestDeleteConfirmation from '../components/guest-list-table/GuestDeleteConfirmation.vue';
import AdminAreaLayout from '../../shared/layouts/AdminAreaLayout.vue';

const props = defineProps({
    guests: {
        type: Array,
        required: true,
    },
});

const totalMainGuestCount = computed(
    () => props.guests
        .filter((guest) => !guest.plus_one_of)
        .length,
);
const totalPotentialPlusOnes = computed(
    () => props.guests
        .filter((guest) => guest.plus_one_allowed)
        .length,
);

const totalInvitesCount = computed(() => {
    const groupIds = props.guests.map((guest) => guest.group_id);
    const uniqueGroupIds = [...new Set(groupIds)];
    return uniqueGroupIds.length + props.guests.filter((guest) => !guest.group_id).length;
});
const dayGuestCount = computed(() => props.guests.filter((guest) => guest.guest_type === 'all_day').length);
const eveningGuestCount = computed(() => props.guests.filter((guest) => guest.guest_type === 'evening').length);

const potentialDayPlusOnes = computed(() => props.guests.filter((guest) => guest.guest_type === 'all_day' && guest.plus_one_allowed).length);
const potentialEveningPlusOnes = computed(() => props.guests.filter((guest) => guest.guest_type === 'evening' && guest.plus_one_allowed).length);

const totalRemainingRsvps = computed(() => {
    const rsvps = props.guests.filter((guest) => guest.rsvp_response === null);
    return rsvps.length;
});

const stats = reactive([
    {
        id: 1,
        stats: [
            { name: 'Day Guests', stat: dayGuestCount.value },
            { name: 'Evening Guests', stat: eveningGuestCount.value },
            { name: 'Total Invited Guests', stat: totalMainGuestCount.value },
            { name: 'RSVPs Received', stat: totalMainGuestCount.value - totalRemainingRsvps.value },
            { name: 'Remaining RSVPs', stat: totalRemainingRsvps.value },

        ],
    },
    {
        id: 2,
        stats: [
            { name: 'Potential Day Plus Ones', stat: potentialDayPlusOnes.value },
            { name: 'Potential Evening Plus Ones', stat: potentialEveningPlusOnes.value },
            { name: 'Total Potential Plus Ones', stat: totalPotentialPlusOnes.value },
            { name: 'Total Invites (grouped guests count as 1)', stat: totalInvitesCount.value },
        ],
    },
]);

const { setGuestList, reloadGuestList } = useGuestList();

setGuestList(props.guests);

const addGuestFormOpen = ref(false);
const detailsModalOpen = ref(false);
const openDetailsToPlusOne = ref(false);
const selectedGuest = ref(null);

const deletingGuest = ref(null);
const deletingGuestModalOpen = ref(false);

const openDeleteConfirmation = (guest) => {
    deletingGuest.value = guest;
    deletingGuestModalOpen.value = true;
};

const closeDeleteConfirmation = () => {
    deletingGuest.value = null;
    deletingGuestModalOpen.value = false;
};

const openDetailsModal = (guest) => {
    selectedGuest.value = guest;
    detailsModalOpen.value = true;
};

const openDetailsModalToPlusOne = (guest) => {
    selectedGuest.value = guest;
    detailsModalOpen.value = true;
    openDetailsToPlusOne.value = true;
};

const closeDetailsModal = () => {
    selectedGuest.value = null;
    detailsModalOpen.value = false;
    openDetailsToPlusOne.value = false;
};

const toggleForm = () => {
    addGuestFormOpen.value = !addGuestFormOpen.value;
};
const goToGuestRsvpForm = (guest) => {
    router.visit(route('guest.rsvp.form', { code: guest.unique_code }));
};

</script>

  <style lang="postcss" scoped>
  .v-enter-active,
  .v-leave-active {
      transition: all 0.4s ease;
  }

  .v-enter-from,
  .v-leave-to {
      z-index: -1;
      opacity: 0;
      transform: translateY(-200px);
  }
  </style>
