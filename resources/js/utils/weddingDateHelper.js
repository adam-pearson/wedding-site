import moment from 'moment';

export default function useWeddingDateHelper() {
    const WEDDING_DATE = '2024-10-02 13:00:00';

    const getFormattedWeddingDate = (format) => moment(WEDDING_DATE).format(format);

    return {
        WEDDING_DATE,
        getFormattedWeddingDate,
    };
}
