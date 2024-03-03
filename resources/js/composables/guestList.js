import axios from 'axios';
import { ref } from 'vue';

const guestList = ref([]);

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

    return {
        guestList,
        setGuestList,
        reloadGuestList,
        saveNewGuest,
    };
}
