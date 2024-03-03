<template>
    <AdminLayout>
        <GuestListSection />
    </AdminLayout>
</template>
<script setup>
import GuestListSection from '../../components/Admin/GuestList/GuestListSection.vue';
import AdminLayout from '../../layouts/AdminLayout.vue';
import useGuestList from '../../composables/guestList';

const props = defineProps({
    guests: {
        type: Array,
        required: true,
    },
});

const { setGuestList } = useGuestList();

setGuestList(props.guests);
</script>
