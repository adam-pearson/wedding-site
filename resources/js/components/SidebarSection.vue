<template>
    <aside
        class="flex flex-col justify-between py-16 px-8 fixed bottom-0 top-0 left-0 overflow-y-scroll z-[1001] bg-secondary duration-[0.5s] xl:w-[22%] md:w-[30%] w-[270px] sm:translate-x-[0] translate-x-[-270px]">

        <!-- Logo -->
        <div class="text-center pb-16 w-full text-black leading-5">
            <a :href="route('home')" class="flex flex-col items-center">
                <img class="w-[90px] mb-0" src="../../../resources/assets/logo.png" alt="">
                <span class="font-script font-normal normal-case text-4xl text-primary">Heather <small>&</small> Adam</span>
                <h6 class="font-sans mb-2 text-xs tracking-[5px]">02.10.2024</h6>
            </a>
        </div>
        <!-- Menu -->
        <nav>
            <ul class="text-center p-0 mx-0 mt-0 sm:mb-0 mb-8">
                <li 
                v-for="navItem in navItems" 
                :key="navItem.text" 
                class="my-[3px] pb-[3px]">
                    <a :href="navItem.route"
                    class="font-serif text-lg leading-6 tracking-wide duration-[0.3s] border-b border-b-transparent hover:border-b-primary hover:duration-[0.5s]">
                        {{ navItem.text }}
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar Footer -->
        <div class="flex flex-col items-center pt-16 text-center m-0 text-xs tracking-wide text-gray-600 ">
            <span class="w-20 border-b border-b-primary inline-block my-2"></span>
            <p>Heather & Adam wedding<br />2nd October 2024</p>
        </div>
    </aside>
</template>
<script setup>

const navItems = 
[
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
]
</script>

<style lang="postcss" scoped>
::-webkit-scrollbar {
    width: 0px;
}

::-webkit-scrollbar-track {
    background: #fff;
}

::-webkit-scrollbar-thumb {
    background: #BD945A;
}

::-webkit-scrollbar-thumb:hover {
    background: #BD945A;
}

@media screen and (max-width: 768px) {
    #oliven-aside {
        width: 270px;
        transform: translateX(-270px);
        padding-top: 30px;
    }
}

@media screen and (max-width: 768px) {
    #oliven-aside .oliven-logo {
        margin-bottom: 60px;
    }
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
}</style>