const STATUS_TYPES = {
    NOT_SENT: {
        value: 'not_sent',
        displayName: 'Not Sent',
        classes: ['bg-gray-50', 'text-gray-600', 'ring-gray-500/10'],
    },
    NOT_RESPONDED: {
        value: 'not_responded',
        displayName: 'Not Responded',
        classes: ['bg-yellow-50', 'text-yellow-800', 'ring-yellow-600/20'],
    },
    DECLINED: {
        value: 'declined',
        displayName: 'Declined',
        classes: ['bg-red-50', 'text-red-700', 'ring-red-600/10'],
    },
    ACCEPTED: {
        value: 'accepted',
        displayName: 'Accepted',
        classes: ['bg-green-50', 'text-green-700', 'ring-green-600/20'],
    },
};

export default STATUS_TYPES;
