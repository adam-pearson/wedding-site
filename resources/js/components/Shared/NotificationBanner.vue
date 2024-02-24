<template>
    <div v-if="errors.length" class="rounded-md bg-red-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
                <div class="text-sm text-red-700">
                    <ul role="list" class="list-disc space-y-1 pl-5">
                        <li v-for="error of errors" :key="error.id">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { XCircleIcon } from '@heroicons/vue/20/solid';

defineProps({
    errors: {
        type: Array,
        required: false,
        default: () => [],
    },
});
</script>
