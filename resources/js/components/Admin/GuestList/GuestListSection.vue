<template>
    <GuestListHeader
        @open-add-guest-form="toggleForm"
        :form-open="addGuestFormOpen"
    />
    <Transition>
        <GuestListForm
            v-if="addGuestFormOpen"
            @close-form="toggleForm"
            @submitted="loadLatestGuests"
        />
    </Transition>
    <GuestListTable :guests="latestGuests" class="py-4" />
</template>
<script setup>
import axios from 'axios';
import { ref } from 'vue';
import GuestListHeader from './GuestListHeader.vue';
import GuestListForm from './GuestListForm.vue';
import GuestListTable from './GuestListTable.vue';

const props = defineProps({
    guests: {
        type: Array,
        required: true,
    },
});

const latestGuests = ref(props.guests);

const addGuestFormOpen = ref(false);

const toggleForm = () => {
    addGuestFormOpen.value = !addGuestFormOpen.value;
};

const loadLatestGuests = () => {
    axios.get(route('admin.guests.list')).then((res) => {
        latestGuests.value = res.data.guests;
    });
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
