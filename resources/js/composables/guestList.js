import axios from 'axios';
import { ref } from 'vue';

const guestList = ref([]);

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
        axios.put(route('admin.guests.update', { id: guestId }), guestForm).then(() => {
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

    return {
        loading,
        guestList,
        setGuestList,
        reloadGuestList,
        saveNewGuest,
        getGuestType,
        updateGuest,
        deleteGuest,
    };
}
