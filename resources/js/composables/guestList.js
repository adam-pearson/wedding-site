import axios from 'axios';
import { ref } from 'vue';

const guestList = ref([]);

const GUEST_TYPE_MAP = {
    all_day: 'All Day',
    evening: 'Evening',
};

export default function useGuestList() {
    const setGuestList = (guests) => {
        guestList.value = guests;
    };

    const reloadGuestList = async () => axios.get(route('admin.guests.list')).then((res) => {
        setGuestList(res.data.guests);
    });

    const saveNewGuest = async (guestForm) => axios.post(route('admin.guests.store'), guestForm).then(() => {
        reloadGuestList();
    });

    const updateGuest = async (guestId, guestForm) => axios.put(route('admin.guests.update', { id: guestId }), guestForm).then(() => {
        reloadGuestList();
    });

    const deleteGuest = async (guestId) => axios.delete(route('admin.guests.destroy', { id: guestId })).then(() => {
        reloadGuestList();
    });

    function getGuestType(guest) {
        if (Object.keys(GUEST_TYPE_MAP).includes(guest.guest_type)) {
            return GUEST_TYPE_MAP[guest.guest_type];
        }

        return 'Unknown';
    }

    return {
        guestList,
        setGuestList,
        reloadGuestList,
        saveNewGuest,
        getGuestType,
        updateGuest,
        deleteGuest,
    };
}
