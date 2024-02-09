<template>
    <!-- eslint-disable max-len -->
    <div id="story" class="story section-padding">
        <div>
            <div
                class="flex w-full flex-col gap-0 px-4 py-16 md:flex-row md:gap-4 md:py-20 lg:px-16"
            >
                <div class="story-img md:mb-30 relative w-full md:w-[30%]">
                    <div
                        class="animate-box relative"
                        data-animate-effect="fadeInLeft"
                    >
                        <div class="img relative pb-8 pl-4 pr-8">
                            <img
                                src="/images/story_small.webp"
                                class="relative z-[2]"
                                alt=""
                            />
                        </div>
                        <div
                            class="story-img-2 story-wedding animate-spin-slow absolute right-[8%] top-[4%] z-[3] h-[35%] w-[31%] bg-[url('/resources/assets/wedding-logo.png')] bg-cover bg-center bg-no-repeat md:right-[15%] md:top-[3%] md:h-[35%] md:w-[31%] lg:right-[10%] lg:top-[3%]"
                        ></div>
                    </div>
                </div>
                <div
                    class="animate-box w-full px-4 py-4 md:w-[70%] md:py-0"
                    data-animate-effect="fadeInRight"
                >
                    <h4
                        class="leading-2 relative top-3 mb-3 font-script text-3xl text-primary"
                    >
                        Our love.
                    </h4>
                    <h3
                        class="oliven-story-title mb-4 font-serif text-3xl font-medium uppercase tracking-wider text-black"
                    >
                        Our Story
                    </h3>
                    <div class="story-text flex flex-col gap-4">
                        <p>
                            Adam and Heather's love story began unexpectedly on
                            April 27th, 2019, at a wine festival they both
                            attended last-minute after snagging free tickets.
                            Despite not planning to be there, they crossed paths
                            and hit it off instantly. When COVID-19 hit, they
                            were separated physically but stayed connected
                            through daily Skype calls. In 2021, Heather moved in
                            with Adam and his parents for what was meant to be a
                            short stay during lockdown, but it turned into over
                            a year.
                        </p>
                        <h4 class="font-serif text-2xl font-medium">
                            Dec 16th, 2023, she Said Yes!
                        </h4>
                        <p>
                            Amidst renovating Heather's parents' house, which
                            they bought together, Adam surprised Heather with a
                            proposal on December 16th, 2023, at Surprise View in
                            the Lake District. Overlooking the stunning scenery,
                            he asked her to be his partner for life, and she
                            accepted. Their journey, from a chance meeting at a
                            wine festival to a heartfelt proposal amidst
                            nature's beauty, is a testament to the strength of
                            their love and commitment through life's
                            unpredictable twists and turns.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- eslint-enable max-len -->
</template>

<script setup></script>

<style scoped lang="postcss">
.story-text p {
    @apply font-sans;
    @apply leading-7;
    @apply text-lightgray;
    @apply text-sm;
}
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
