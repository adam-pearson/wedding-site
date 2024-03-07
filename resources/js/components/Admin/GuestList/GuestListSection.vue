<template>
  <GuestDetailsModal
    v-if="detailsModalOpen && selectedGuest"
    :open="detailsModalOpen"
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
    <GuestListForm
      v-if="addGuestFormOpen"
      @close-form="toggleForm"
      @submitted="reloadGuestList"
    />
  </Transition>
  <GuestListTable
    @view="openDetailsModal"
    @delete="openDeleteConfirmation"
    class="py-4"
  />
</template>
<script setup>
import { ref } from 'vue';
import GuestDetailsModal from './GuestDetailsModal.vue';
import GuestListHeader from './GuestListHeader.vue';
import GuestListForm from './GuestListForm.vue';
import GuestListTable from './GuestListTable.vue';
import useGuestList from '../../../composables/guestList';
import GuestDeleteConfirmation from './GuestDeleteConfirmation.vue';

const { reloadGuestList } = useGuestList();

const addGuestFormOpen = ref(false);
const detailsModalOpen = ref(false);
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

const closeDetailsModal = () => {
    selectedGuest.value = null;
    detailsModalOpen.value = false;
};

const toggleForm = () => {
    addGuestFormOpen.value = !addGuestFormOpen.value;
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
