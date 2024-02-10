<template>
    <!-- eslint-disable max-len -->
    <div class="story-img md:mb-30 relative w-full md:w-[30%]">
        <div class="animate-box relative" data-animate-effect="fadeInLeft">
            <div class="img relative pb-8 pl-4 pr-8">
                <img
                    src="/images/story_small.webp"
                    class="relative z-[2]"
                    alt=""
                />
            </div>
            <div
                class="story-img-2 story-wedding absolute right-[8%] top-[4%] z-[3] h-[35%] w-[31%] animate-spin-slow bg-[url('/resources/assets/wedding-logo.png')] bg-cover bg-center bg-no-repeat md:right-[15%] md:top-[3%] md:h-[35%] md:w-[31%] lg:right-[10%] lg:top-[3%]"
            ></div>
        </div>
    </div>
    <!-- eslint-enable max-len -->
</template>

<style lang="postcss" scoped>
.story .story-img .img:before {
    content: '';
    position: absolute;
    top: 30px;
    right: 0;
    left: 45px;
    bottom: 0;
    border: 10px solid #bd945a;
}
.story .story-img:after {
    content: '';
    width: 90%;
    position: absolute;
    top: -18%;
    bottom: -25%;
    left: 0;
    background-image: url(/resources/assets/dots.png);
    background-repeat: repeat;
    z-index: -1;
}
</style>
