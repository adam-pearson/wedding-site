<template>
  <!-- eslint-disable max-len -->
  <TransitionRoot
    as="template"
    :show="open"
  >
    <Dialog
      as="div"
      class="relative z-[99999]"
      @close="emit('close')"
    >
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
                  <div
                    class="flex w-full items-center justify-between"
                  >
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
                        class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
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
                        class="rounded-md bg-amber-500 px-4 py-2 text-white transition duration-75 hover:bg-amber-900"
                      >
                        View Plus One
                      </button>
                      <button
                        v-if="!deleting"
                        class="rounded-md px-4 py-2 text-amber-500 transition duration-75 hover:bg-amber-500 hover:text-white"
                        @click="deleting = true"
                      >
                        <TrashIcon
                          class="h-4 w-4"
                        />
                      </button>
                      <div
                        v-else
                        class="flex flex-col gap-2"
                      >
                        <button
                          @click="confirmDelete"
                          class="rounded-md px-4 py-2 bg-red-500 text-white transition duration-75 hover:bg-red-900"
                        >
                          Confirm Delete
                        </button>
                        <button
                          @click="deleting = false"
                          class="text-sm"
                        >
                          Cancel
                        </button>
                      </div>
                      <button
                        @click="editing = !editing"
                        class="rounded-md px-4 py-2 text-amber-500 transition duration-75 hover:bg-amber-500 hover:text-white"
                      >
                        <LockOpenIcon
                          v-if="editing"
                          class="h-4 w-4"
                        />
                        <LockClosedIcon
                          v-else
                          ty
                          class="h-4 w-4"
                        />
                      </button>
                      <button
                        @click="emit('close')"
                        class="rounded-md p-2 text-amber-500 transition duration-150 hover:bg-amber-500 hover:text-white"
                      >
                        <XMarkIcon class="h-4 w-4" />
                      </button>
                    </div>
                  </div>
                  <!-- DONT FORGET TO SWITCH EDITING CONDITION -->
                  <EditGuestForm
                    v-if="editing"
                    :guest="selectedGuest"
                    @finished-editing="emit('close')"
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
import {
    XMarkIcon,
    LockClosedIcon,
    LockOpenIcon,
    TrashIcon,
} from '@heroicons/vue/24/outline';
import EditGuestForm from './EditGuestForm.vue';
import GuestDetails from './GuestDetails.vue';
import useGuestList from '../../../composables/guestList';

const { deleteGuest } = useGuestList();

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
    () => selectedGuest.value.id === props.guest.plus_one_child.id,
);

const selectedGuestIsMainGuest = computed(
    () => selectedGuest.value.id === props.guest.id,
);

const guestHasPlusOne = computed(() => Boolean(props.guest?.plus_one_child));

const editing = ref(false);
const deleting = ref(false);

const confirmDelete = () => {
    deleteGuest(selectedGuest.value.id);
    emit('close');
};

</script>
./EditGuestForm.vue
