<template>
    <!-- eslint-disable max-len -->
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-[99999]" @close="emit('close')">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div
                    class="flex min-h-full justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6"
                        >
                            <div>
                                <div class="">
                                    <div class="flex w-full justify-between">
                                        <DialogTitle
                                            as="h3"
                                            class="text-2xl font-semibold leading-6 text-gray-900"
                                        >
                                            {{
                                                editing
                                                    ? 'Editing Guest'
                                                    : 'Guest Details'
                                            }}
                                        </DialogTitle>
                                        <div class="flex gap-4">
                                            <button
                                                v-if="
                                                    guestHasPlusOne &&
                                                    selectedGuestIsPlusOne
                                                "
                                                @click="selectedGuest = guest"
                                            >
                                                View Main Guest
                                            </button>
                                            <button
                                                v-if="
                                                    guestHasPlusOne &&
                                                    selectedGuestIsMainGuest
                                                "
                                                @click="
                                                    selectedGuest =
                                                        guest.plus_one_child
                                                "
                                            >
                                                View Plus One
                                            </button>
                                            <button @click="editing = !editing">
                                                {{
                                                    editing
                                                        ? 'Stop Editing'
                                                        : 'Edit'
                                                }}
                                            </button>
                                            <button>X</button>
                                        </div>
                                    </div>
                                    <!-- DONT FORGET TO SWITCH EDITING CONDITION -->
                                    <EditGuestForm
                                        v-if="editing"
                                        :guest="selectedGuest"
                                        @finished-editing="editing = false"
                                    />
                                    <GuestDetails
                                        v-else
                                        :guest="selectedGuest"
                                    />
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
    <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref, computed } from 'vue';
import {
    Dialog,
    DialogTitle,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import EditGuestForm from './EditGuestForm.vue';
import GuestDetails from './GuestDetails.vue';

const emit = defineEmits(['close']);

const props = defineProps({
    open: {
        type: Boolean,
        required: true,
    },
    guest: {
        type: Object,
        required: true,
    },
});

const selectedGuest = ref(props.guest);

const selectedGuestIsPlusOne = computed(
    () => selectedGuest.value.id === props.guest.plus_one_child.id
);

const selectedGuestIsMainGuest = computed(
    () => selectedGuest.value.id === props.guest.id
);

const guestHasPlusOne = computed(() => Boolean(props.guest?.plus_one_child));

const dummyPlusOne = {
    id: 1,
    name: 'Laura Bailey',
    email: 'laura@gmail.com',
    phone: '06876628173',
    address: '72 Faircrest Drive, Eccles, M26 0GH',
    guest_type: 'all_day',
    plus_one_of: 1,
    plus_one_allowed: 1,
    unique_code: 'AC635F',
    invite_sent_at: '2024-02-03',
    created_at: '2024-03-03T20:20:23.000000Z',
    updated_at: '2024-03-03T20:20:23.000000Z',
    deleted_at: null,
    is_child: 0,
    received_invite: {
        id: 2,
        coming: true,
        alcohol: true,
        dietary_requirements: null,
    },
    plus_one_child: {
        id: 8,
        name: 'Travis Willingham',
        email: 'travis@gmail.com',
        phone: '08489923178',
        address: '72 Faircrest Drive, Eccles, M26 0GH',
        guest_type: 'all_day',
        plus_one_of: null,
        plus_one_allowed: 1,
        unique_code: 'AC635F',
        invite_sent_at: null,
        created_at: '2024-03-03T20:20:23.000000Z',
        updated_at: '2024-03-03T20:20:23.000000Z',
        deleted_at: null,
        is_child: 0,
        received_invite: {
            id: 1,
            coming: true,
            alcohol: true,
            dietary_requirements: 'Vegan',
        },
    },
};

// selectedGuest.value = dummyPlusOne;
const editing = ref(false);
</script>
./EditGuestForm.vue
