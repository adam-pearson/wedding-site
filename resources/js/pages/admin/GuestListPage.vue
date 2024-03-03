<template>
    <AdminLayout>
        <GuestListSection :guests="guests" />
    </AdminLayout>
</template>
<script setup>
import GuestListSection from '../../components/Admin/GuestList/GuestListSection.vue';
import AdminLayout from '../../layouts/AdminLayout.vue';

defineProps({
    guests: {
        type: Array,
        required: true,
    },
});
</script>
