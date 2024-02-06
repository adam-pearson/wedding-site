<template>
    <header
        id="home"
        class="hero-image flex h-screen items-center justify-center"
    >
        <div>
            <div>
                <div class="text-center">
                    <h5 class="hero-caption">The wedding of</h5>
                    <h1 class="hero-names">Heather & Adam</h1>
                    <h5 class="hero-caption">2nd October, 2024</h5>
                </div>
            </div>
            <!-- <div>
                <div>
                    <div class="arrow bounce text-center">
                        <a href="index.html#couple"> <i class="ti-heart"></i> </a>
                    </div>
                </div>
            </div> -->
        </div>
    </header>
</template>

<script setup></script>

<style scoped lang="postcss">
.hero-image {
    @apply bg-[url(/resources/assets/heroImage.jpg)];
    @apply bg-cover;
    @apply bg-no-repeat;
    @apply bg-center;
    @apply overflow-hidden;
}
.hero-names {
    @apply font-script;
    @apply my-0;
    @apply text-[40px];
    @apply md:text-[7.5rem];
    @apply text-white;
    @apply leading-[7.5rem];
    @apply md:my-4;
    @apply md:leading-none;
}

.hero-caption {
    @apply font-sans;
    @apply text-[12px];
    @apply md:text-xl;
    @apply tracking-[5px];
    @apply text-white;
    @apply uppercase;
}
</style>
