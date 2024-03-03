<template>
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
    <GuestListTable class="py-4" />
</template>
<script setup>
import { ref } from 'vue';
import GuestListHeader from './GuestListHeader.vue';
import GuestListForm from './GuestListForm.vue';
import GuestListTable from './GuestListTable.vue';
import useGuestList from '../../../composables/guestList';

const { reloadGuestList } = useGuestList();

const addGuestFormOpen = ref(false);

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
