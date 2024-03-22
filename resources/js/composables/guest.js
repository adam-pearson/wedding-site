import { ref, readonly } from 'vue';
import STATUS_TYPES from '../constants/inviteStatus';

const guest = ref({});

export default function useGuest() {
    const setGuest = (guestData) => {
        guest.value = guestData;
    };

    const getInviteStatus = (guestData) => {
        if (guestData?.received_invite) {
            return STATUS_TYPES[guestData.received_invite.coming ? 'accepted' : 'rejected'].value;
        }

        if (guestData?.invite_sent) {
            return STATUS_TYPES.not_responded.value;
        }

        return STATUS_TYPES.not_sent.value;
    };

    return {
        guest: readonly(guest),
        setGuest,
        getInviteStatus,
    };
}
