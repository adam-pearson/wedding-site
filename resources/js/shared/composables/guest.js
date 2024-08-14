import { ref, readonly } from 'vue';
import STATUS_TYPES from '../constants/inviteStatuses';

const guest = ref(null);
const guestGroup = ref(null);

export default function useGuest() {
    const setGuest = (guestData) => {
        guest.value = guestData;
    };

    const unsetGuest = () => {
        guest.value = null;
    };

    const unsetGuestGroup = () => {
        guestGroup.value = null;
    };
    const setGuestGroup = (guestGroupData) => {
        guestGroup.value = guestGroupData;
    };

    const getInviteStatus = (guestData) => {
        if (guestData?.rsvp_response) {
            return STATUS_TYPES[guestData.rsvp_response.coming ? 'ACCEPTED' : 'DECLINED'].value;
        }

        if (guestData?.invite_sent) {
            return STATUS_TYPES.NOT_RESPONDED.value;
        }

        return STATUS_TYPES.NOT_SENT.value;
    };

    return {
        guest: readonly(guest),
        guestGroup: readonly(guestGroup),
        setGuest,
        unsetGuest,
        setGuestGroup,
        unsetGuestGroup,
        getInviteStatus,
    };
}
