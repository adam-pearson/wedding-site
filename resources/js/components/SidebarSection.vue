<template>
    <!-- eslint-disable max-len -->
    <aside
        class="fixed bottom-0 left-0 top-0 z-[1001] flex w-[270px] translate-x-[-270px] flex-col justify-between overflow-y-scroll bg-secondary px-8 py-8 duration-[0.5s] sm:translate-x-[0] md:w-[30%] md:py-16 xl:w-[22%]"
    >
        <!-- Logo -->
        <div class="w-full pb-16 text-center leading-5 text-black">
            <a :href="route('home')" class="flex flex-col items-center">
                <img
                    class="mb-0 w-[90px]"
                    src="../../../resources/assets/logo.png"
                    alt=""
                />
                <span
                    class="font-script text-4xl font-normal normal-case text-primary"
                    >Heather <small>&</small> Adam</span
                >
                <h6 class="mb-2 font-sans text-xs tracking-[5px]">
                    02.10.2024
                </h6>
            </a>
        </div>
        <!-- Menu -->
        <nav>
            <ul class="mx-0 mb-8 mt-0 p-0 text-center sm:mb-0">
                <li
                    v-for="navItem in navItems"
                    :key="navItem.text"
                    class="my-[3px] pb-[3px]"
                >
                    <a
                        :href="navItem.route"
                        class="border-b border-b-transparent font-serif text-lg leading-6 tracking-wide duration-[0.3s] hover:border-b-primary hover:duration-[0.5s]"
                    >
                        {{ navItem.text }}
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar Footer -->
        <div
            class="m-0 flex flex-col items-center pt-16 text-center text-xs tracking-wide text-gray-600"
        >
            <span
                class="my-2 inline-block w-20 border-b border-b-primary"
            ></span>
            <p>Heather & Adam wedding<br />2nd October 2024</p>
        </div>
    </aside>
    <!-- eslint-enable max-len -->
</template>
<script setup>
const navItems = [
    {
        text: 'Home',
        route: route('home'),
    },
    {
        text: 'Couple',
        route: '#couple',
    },
    {
        text: 'Our Story',
        route: '#story',
    },
    {
        text: 'Friends',
        route: '#friends',
    },
    {
        text: 'Organization',
        route: '#organization',
    },
    {
        text: 'Gallery',
        route: '#gallery',
    },
    {
        text: 'When & Where',
        route: '#whenwhere',
    },
    {
        text: 'R.S.V.P.',
        route: '#rsvp',
    },
    {
        text: 'Gift Registry',
        route: '#gift',
    },
    {
        text: 'Blog',
        route: route('home'),
    },
];
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
