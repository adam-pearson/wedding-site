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
              class="relative overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6"
            >
              <div>
                <div class="">
                  <div
                    class="flex w-full items-start justify-between"
                  >
                    <DialogTitle
                      as="h3"
                      class="flex flex-col gap-2 text-2xl font-semibold leading-6 text-gray-900"
                    >
                      {{ selectedGuest.name }}
                      <span
                        v-if="selectedGuestIsPlusOne"
                        class="text-sm text-gray-500"
                      >Plus One of {{ guest.name }}</span>
                    </DialogTitle>
                    <div class="flex gap-4">
                      <button
                        v-if="selectedGuestIsPlusOne || addingPlusOne"
                        @click="viewMainGuest"
                        class="self-start rounded-md bg-amber-500 px-4 py-2 text-sm text-white transition duration-75 hover:bg-amber-900"
                      >
                        Main Guest
                      </button>
                      <button
                        v-if="!guestHasPlusOne && selectedGuestIsMainGuest && selectedGuest.plus_one_allowed && !addingPlusOne"
                        @click="addPlusOne"
                        class="self-start rounded-md bg-amber-500 px-4 py-2 text-sm text-white transition duration-75 hover:bg-amber-900"
                      >
                        Add Plus One
                      </button>
                      <button
                        v-if="guestHasPlusOne && selectedGuestIsMainGuest"
                        @click="viewPlusOne"
                        class="self-start rounded-md bg-amber-500 px-4 py-2 text-sm text-white transition duration-75 hover:bg-amber-900"
                      >
                        Plus One
                      </button>
                      <button
                        v-if="!deleting"
                        class="rounded-md px-4 py-2 text-amber-500 transition duration-75 hover:bg-amber-500 hover:text-white"
                        @click="deleting = true"
                      >
                        <TrashIcon
                          class="size-4"
                        />
                      </button>
                      <div
                        v-else
                        class="flex flex-col gap-2"
                      >
                        <button
                          @click="confirmDelete"
                          class="rounded-md bg-red-500 px-4 py-2 text-white transition duration-75 hover:bg-red-900"
                        >
                          Confirm
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
                          class="size-4"
                        />
                        <LockClosedIcon
                          v-else
                          ty
                          class="size-4"
                        />
                      </button>
                      <button
                        @click="emit('close')"
                        class="rounded-md p-2 text-amber-500 transition duration-150 hover:bg-amber-500 hover:text-white"
                      >
                        <XMarkIcon class="size-4" />
                      </button>
                    </div>
                  </div>
                  <EditGuestForm
                    :editing="editing"
                    :adding-plus-one="addingPlusOne"
                    :guest="selectedGuest"
                    @finished-editing="emit('close')"
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
import { ref, computed, onMounted } from 'vue';
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
import { cloneDeep } from 'lodash';
import EditGuestForm from './EditGuestForm.vue';
import useGuestList from '../../composables/guestList';

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
    openToPlusOne: {
        type: Boolean,
        default: false,
    },
});

const editing = ref(false);
const addingPlusOne = ref(false);
const deleting = ref(false);

const selectedGuest = ref(props.guest);

const selectedGuestIsPlusOne = computed(
    () => selectedGuest.value.id === props.guest.plus_one?.id,
);

const selectedGuestIsMainGuest = computed(
    () => selectedGuest.value.id === props.guest.id,
);

const guestHasPlusOne = computed(() => Boolean(props.guest?.plus_one));

const addPlusOne = () => {
    selectedGuest.value = cloneDeep(props.guest);
    editing.value = true;
    addingPlusOne.value = true;
};

const confirmDelete = () => {
    deleteGuest(selectedGuest.value.id);
    emit('close');
};

const viewMainGuest = () => {
    selectedGuest.value = props.guest;
    editing.value = false;
    addingPlusOne.value = false;
};

const viewPlusOne = () => {
    selectedGuest.value = props.guest.plus_one;
    editing.value = false;
    addingPlusOne.value = false;
};

onMounted(() => {
    if (props.openToPlusOne) {
        selectedGuest.value = props.guest.plus_one;
    }
});

</script>
./EditGuestForm.vue
