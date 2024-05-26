import { ref, readonly } from 'vue';
import STATUS_TYPES from '../constants/inviteStatuses';

const guest = ref({});
const canRsvpOnBehalfOf = ref([]);

export default function useGuest() {
    const setGuest = (guestData) => {
        guest.value = guestData;
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

    const setCanRsvpOnBehalfOf = (guestData) => {
        canRsvpOnBehalfOf.value = guestData;
    };

    const removeFromCanRsvpOnBehalfOf = (guestId) => {
        console.log('attempting to filter out guest', guestId);
        // eslint-disable-next-line no-shadow
        canRsvpOnBehalfOf.value = canRsvpOnBehalfOf.value.filter((iterableGuest) => iterableGuest.id !== guestId);
        console.log('canRsvpOnBehalfOf', canRsvpOnBehalfOf.value);
    };

    return {
        guest: readonly(guest),
        canRsvpOnBehalfOf: readonly(canRsvpOnBehalfOf),
        setGuest,
        getInviteStatus,
        removeFromCanRsvpOnBehalfOf,
        setCanRsvpOnBehalfOf,
    };
}
