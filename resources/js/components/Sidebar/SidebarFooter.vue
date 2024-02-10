<template>
    <div
        class="m-0 flex flex-col items-center pt-16 text-center text-xs tracking-wide text-gray-600"
    >
        <span class="my-2 inline-block w-20 border-b border-b-primary"></span>
        <p>
            Heather & Adam's Wedding<br />
            {{ getFormattedWeddingDate('Do MMMM YYYY') }}
        </p>
    </div>
</template>
<script setup>
import useWeddingDateHelper from '../../utils/weddingDateHelper';

const { getFormattedWeddingDate } = useWeddingDateHelper();
</script>
