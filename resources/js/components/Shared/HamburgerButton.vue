<template>
    <!-- eslint-disable max-len -->
    <button
        @click="emit('clicked')"
        class="hamburger visible fixed left-0 top-0 z-[9999] mx-8 my-4 rounded-full bg-primary px-4 py-3 opacity-100 duration-500 sm:hidden sm:opacity-0"
    >
        <i
            class="relative top-[-4px] inline-block h-[1px] w-[19px] bg-white indent-14 font-[Helvetica] text-sm font-bold uppercase text-white transition-all duration-200"
        ></i>
    </button>
    <!-- eslint-enable max-len -->
</template>

<script setup>
const emit = defineEmits(['clicked']);
</script>

<style lang="postcss" scoped>
.hamburger:hover,
.hamburger:focus,
.hamburger:active {
    outline: none;
    border-bottom: none !important;
}
.hamburger i::before,
.hamburger i::after {
    content: '';
    width: 20px;
    height: 1px;
    background: #fff;
    position: absolute;
    left: 0;
    transition: 0.2s;
}
.hamburger i::before {
    top: -7px;
}
.hamburger i::after {
    bottom: -7px;
}
.hamburger:hover i::before {
    top: -10px;
}
.hamburger:hover i::after {
    bottom: -10px;
}
.hamburger.active i {
    background: transparent;
}
.hamburger.active i::before {
    top: 0;
    transform: rotateZ(45deg);
}
.hamburger.active i::after {
    bottom: 0;
    transform: rotateZ(-45deg);
}
</style>
