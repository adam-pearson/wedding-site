import axios from 'axios';
import { ref, computed, readonly } from 'vue';

const guestList = ref([]);

const guestListForSelect = computed(() => guestList.value
    .filter((guest) => guest.plus_one_of === null)
    .map((guest) => ({
        value: guest.id,
        label: guest.name,
    })));

const GUEST_TYPE_MAP = {
    all_day: 'All Day',
    evening: 'Evening',
};

const loading = ref(false);

export default function useGuestList() {
    const setGuestList = (guests) => {
        guestList.value = guests;
    };

    const reloadGuestList = async () => {
        loading.value = true;
        axios.get(route('admin.guests.list')).then((res) => {
            loading.value = false;
            setGuestList(res.data.guests);
        });
    };

    const saveNewGuest = async (guestForm, parentId = null) => {
        loading.value = true;
        axios.post(route('admin.guests.store', { plus_one_of: parentId }), guestForm).then(() => {
            loading.value = false;
            reloadGuestList();
        });
    };

    const updateGuest = async (guestId, guestForm) => {
        loading.value = true;
        axios.patch(route('admin.guests.update', { guest: guestId }), guestForm).then(() => {
            loading.value = false;
            reloadGuestList();
        });
    };

    const deleteGuest = async (guestId) => {
        loading.value = true;
        axios.delete(route('admin.guests.destroy', { id: guestId })).then(() => {
            loading.value = false;
            reloadGuestList();
        });
    };

    function getGuestType(guest) {
        if (Object.keys(GUEST_TYPE_MAP).includes(guest.guest_type)) {
            return GUEST_TYPE_MAP[guest.guest_type];
        }

        return 'Unknown';
    }

    function getGuestListForSelectWithoutCurrentGuest(currentGuestId) {
        return guestListForSelect.value.filter((guest) => guest.value !== currentGuestId);
    }

    return {
        loading,
        guestList: readonly(guestList),
        guestListForSelect: readonly(guestListForSelect),
        setGuestList,
        reloadGuestList,
        saveNewGuest,
        getGuestType,
        updateGuest,
        deleteGuest,
        getGuestListForSelectWithoutCurrentGuest,
    };
}
