<template>
  <!-- eslint-disable max-len -->

  <div class="flex items-center justify-between">
    <div class="min-w-0 flex-1">
      <h2
        class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
      >
        Guest List
      </h2>
    </div>
    <div class="flex md:ml-4 md:mt-0">
      <button
        @click="emit('openAddGuestForm')"
        type="button"
        class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
      >
        {{ formOpen ? 'Close Form' : 'Add Guest' }}
      </button>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
const emit = defineEmits(['openAddGuestForm']);
defineProps({
    formOpen: {
        type: Boolean,
        required: true,
    },
});
</script>
