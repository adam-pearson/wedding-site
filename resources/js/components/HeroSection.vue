<template>
    <header id="home" class="flex justify-center items-center h-screen hero-image">
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

<script setup>

</script>

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
    @apply mb-4;
    @apply text-[7.5rem];
    @apply text-white;
    @apply leading-[7.5rem];
}

.hero-caption {
    @apply font-sans;
    @apply text-xl;
    @apply tracking-[5px];
    @apply text-white;
    @apply uppercase;
 }
</style>
