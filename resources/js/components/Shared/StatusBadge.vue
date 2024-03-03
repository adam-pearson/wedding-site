<template>
    <!-- eslint-disable max-len -->
    <span
        class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset"
        :class="typeMap[status].classes"
        >{{ typeMap[status].displayName }}</span
    >
    <!-- eslint-enable max-len -->
</template>

<script setup>
defineProps({
    status: {
        type: String,
        required: true,
    },
});

const typeMap = {
    not_sent: {
        displayName: 'Not Sent',
        classes: ['bg-gray-50', 'text-gray-600', 'ring-gray-500/10'],
    },
    not_responded: {
        displayName: 'Not Responded',
        classes: ['bg-yellow-50', 'text-yellow-800', 'ring-yellow-600/20'],
    },
    rejected: {
        displayName: 'Rejected',
        classes: ['bg-red-50', 'text-red-700', 'ring-red-600/10'],
    },
    accepted: {
        displayName: 'Accepted',
        classes: ['bg-green-50', 'text-green-700', 'ring-green-600/20'],
    },
};
</script>
