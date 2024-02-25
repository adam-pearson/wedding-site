<template>
    <!-- eslint-disable max-len -->
    <aside
        class="fixed bottom-0 left-0 top-0 z-[1001] flex w-[270px] flex-col justify-between overflow-y-scroll bg-secondary px-8 py-8 duration-[0.5s] sm:translate-x-[0] md:w-[30%] md:py-16 xl:w-[22%]"
        :class="navOpen ? 'translate-x-0' : 'translate-x-[-270px]'"
    >
        <div class="flex flex-col">
            <SidebarHeader class="pb-16" />
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
];

const page = usePage();

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
defineProps({
    navOpen: {
        type: Boolean,
        required: true,
    },
});
</script>

<style lang="postcss" scoped>
::-webkit-scrollbar {
    width: 0px;
}

::-webkit-scrollbar-track {
    background: #fff;
}

::-webkit-scrollbar-thumb {
    background: #bd945a;
}

::-webkit-scrollbar-thumb:hover {
    background: #bd945a;
}

#oliven-aside .footer1 {
    position: absolute;
    bottom: 30px;
    right: 0;
    left: 0;
    text-align: center;
}

#oliven-aside .footer1 p {
    font-size: 12px;
    color: #888;
    letter-spacing: 0.5px;
}

#oliven-aside .separator {
    width: 60px;
    position: relative;
    display: inline-block;
    vertical-align: middle;
    border-bottom: 1px solid rgba(189, 148, 90, 0.4);
    margin: 5px auto;
}

@media screen and (max-width: 768px) {
    #oliven-aside .footer1 {
        position: relative;
        padding-top: 60px;
    }
}
</style>
