<template>
  <!-- eslint-disable max-len -->

  <aside
    class="fixed inset-y-0 left-0 z-[1001] flex w-[270px] flex-col items-center justify-between overflow-y-scroll bg-offwhite-500 p-8 shadow-sm duration-[0.5s] sm:translate-x-[0] md:w-[24%] md:py-8 xl:w-[20%]"
    :class="navOpen ? 'translate-x-0' : 'translate-x-[-270px]'"
  >
    <div class="flex flex-col items-center">
      <SidebarHeader class="pb-6" />
      <SidebarNav :nav-items="navItems" />
    </div>

    <SidebarFooter />
  </aside>
  <!-- eslint-enable max-len -->
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import SidebarHeader from './SidebarHeader.vue';
import SidebarNav from './SidebarNav.vue';
import SidebarFooter from './SidebarFooter.vue';

const navigationArray = [
    {
        text: 'Home',
        route: route('home'),
    },
    {
        text: 'Our Story',
        route: '#story',
    },
    {
        text: 'RSVP',
        route: route('guest.rsvp.code'),
    },
];

const page = usePage();

defineProps({
    navOpen: {
        type: Boolean,
        required: true,
    },
});

const isLoggedIn = computed(() => Boolean(page?.props?.auth?.user));

const navItems = computed(() => {
    if (isLoggedIn.value) {
        return [
            ...navigationArray,
            { text: 'Admin Dashboard', route: route('admin.dashboard') },
        ];
    }

    return navigationArray;
});

</script>

<style lang="postcss" scoped>
::-webkit-scrollbar {
    @apply w-0;
}

::-webkit-scrollbar-track {
    @apply bg-white;
}

::-webkit-scrollbar-thumb {
    @apply bg-primary-500;
}

::-webkit-scrollbar-thumb:hover {
    @apply bg-primary-500;
}
</style>
