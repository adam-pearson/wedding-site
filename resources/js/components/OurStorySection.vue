<template>
    <!-- eslint-disable max-len -->
    <div id="story" class="story section-padding">
        <div>
            <div
                class="flex w-full flex-col gap-0 px-4 py-16 md:flex-row md:gap-4 md:py-20 lg:px-16"
            >
                <div class="md:mb-30 w-full md:w-[30%]">
                    <div
                        class="story-img animate-box"
                        data-animate-effect="fadeInLeft"
                    >
                        <div class="img">
                            <img
                                src="/images/story.jpg"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                        <div
                            class="story-img-2 story-wedding bg-[url('/resources/assets/wedding-logo.png')]"
                        ></div>
                    </div>
                </div>
                <div
                    class="animate-box w-full px-4 py-4 md:w-[70%] md:py-0"
                    data-animate-effect="fadeInRight"
                >
                    <h4 class="oliven-story-subtitle">Our love.</h4>
                    <h3 class="oliven-story-title mb-4">Our Story</h3>
                    <div class="flex flex-col gap-4">
                        <p>
                            Curabit aliquet orci elit genes tristique lorem
                            commodo vitae. Tuliaum tincidunt nete sede gravida
                            aliquam, neque libero hendrerit magna, sit amet
                            mollis lacus ithe maurise. Dunya erat volutpat edat
                            themo the druanye semper.
                        </p>
                        <p>
                            Luality fringilla duiman at elit vinibus viverra nec
                            a lacus themo the druanye sene sollicitudin mi
                            suscipit non sagie the fermen.
                        </p>
                        <p>
                            Phasellus viverra tristique justo duis vitae diam
                            neque nivamus ac est augue artine aringilla dui at
                            elit finibus viverra nec a lacus. Nedana themo eros
                            odio semper soe suscipit non. Curabit aliquet orci
                            elit genes tristique.
                        </p>
                        <h4 class="font-serif text-2xl font-medium">
                            Dec 16th, 2023, she Said Yes!
                        </h4>
                        <p>
                            Luality fringilla duiman at elit finibus viverra nec
                            a lacus themo the druanye sene sollicitudin mi
                            suscipit non sagie the fermen.
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
p {
    @apply font-sans;
    @apply leading-7;
    @apply text-lightgray;
    @apply text-sm;
}
.oliven-title {
    color: #000;
    font-family: 'Cormorant Garamond', serif;
    margin-bottom: 0px;
    font-weight: 500;
    font-size: 30px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.oliven-title span {
    display: block;
}
.oliven-story-title {
    color: #000;
    font-family: 'Cormorant Garamond', serif;
    font-weight: 500;
    font-size: 30px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.oliven-story-subtitle {
    display: block;
    position: relative;
    top: 12px;
    font-family: 'Alex Brush', cursive;
    font-weight: 400;
    font-size: 30px;
    color: #bd945a;
    line-height: 1.25em;
    margin-bottom: 10px;
}
.oliven-couple-title {
    display: block;
    position: relative;
    top: 12px;
    font-family: 'Alex Brush', cursive;
    font-weight: 400;
    font-size: 60px;
    color: #bd945a;
    line-height: 1.5em;
    margin-bottom: 5px;
}
.oliven-couple-subtitle {
    color: #000;
    font-family: 'Cormorant Garamond', serif;
    font-weight: 400;
    font-size: 18px;
    margin-bottom: 0;
}
.oliven-title-meta {
    display: block;
    position: relative;
    top: 12px;
    font-family: 'Alex Brush', cursive;
    font-weight: 400;
    font-size: 30px;
    color: #bd945a;
    line-height: 1.5em;
    margin-bottom: 10px;
}

.story .story-img {
    position: relative;
}
.story .story-img .img {
    padding: 0 30px 30px 15px;
    position: relative;
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
.story .story-img .img img {
    position: relative;
    z-index: 2;
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

.story-img-2 {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    position: relative;
}

.story-img .story-img-2 {
    width: 30% !important;
    height: 120px;
    position: absolute;
    top: 15px;
    right: 45px;
    z-index: 3;
}

/* story-wedding */

.story-wedding {
    -webkit-animation: rotation 12s infinite linear;
}
@-webkit-keyframes rotation {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(359deg);
    }
}

@media screen and (max-width: 991px) {
    .story-img .story-img-2 {
        width: 30% !important;
        height: 135px;
        position: absolute;
        top: 40px;
        right: 45px;
    }
}

@media screen and (max-width: 768px) {
    .story-img .story-img-2 {
        width: 40% !important;
        height: 120px;
        position: absolute;
        top: 15px;
        right: 45px;
    }
}
</style>
