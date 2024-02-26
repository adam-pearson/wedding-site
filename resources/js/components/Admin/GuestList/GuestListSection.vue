<template>
    <GuestListHeader
        @open-add-guest-form="openForm"
        :form-open="addGuestFormOpen"
    />
    <Transition>
        <GuestListForm class="py-4" v-if="addGuestFormOpen" />
    </Transition>
    <GuestListTable class="py-4" />
</template>
<script setup>
import { ref } from 'vue';
import GuestListHeader from './GuestListHeader.vue';
import GuestListForm from './GuestListForm.vue';
import GuestListTable from './GuestListTable.vue';

const addGuestFormOpen = ref(false);

const openForm = () => {
    addGuestFormOpen.value = !addGuestFormOpen.value;
};
</script>

<style lang="postcss" scoped>
.v-enter-active,
.v-leave-active {
    transition: all 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
    transform: translateY(-400px);
}
</style>
