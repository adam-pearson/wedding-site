<template>
    <!-- eslint-disable max-len -->
    <a
        :href="item.route"
        class="border-b border-b-transparent font-serif text-lg leading-6 tracking-wide duration-[0.3s] hover:border-b-primary hover:duration-[0.5s]"
    >
        {{ item.text }}
    </a>
    <!-- eslint-enable max-len -->
</template>
<script setup>
defineProps({
    item: {
        type: Object,
        required: true,
    },
});
</script>
