<template>
  <AdminAreaLayout>
    TodoList Goes Here
  </AdminAreaLayout>
</template>
<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AdminAreaLayout from '../../shared/layouts/AdminAreaLayout.vue';

const props = defineProps({
    todoList: {
        type: Array,
        required: true,
    },
});

</script>
