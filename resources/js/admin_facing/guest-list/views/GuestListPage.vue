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
import { ref } from 'vue';
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
