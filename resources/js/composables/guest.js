import { ref } from 'vue';

const guest = ref({});

export default function useGuest() {
    const setGuest = (guestData) => {
        guest.value = guestData;
    };

    return {
        setGuest,
        guest,
    };
}
