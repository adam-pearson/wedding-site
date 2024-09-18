<template>
  <GuestAreaLayout>
    <HeroSection />
    <InfoSection />
    <CountdownSection />
    <OurStorySection />
    <WeddingPartySection />
    <AccommodationSection />
    <!--    <FaqSection />-->
    <FooterSection />
  </GuestAreaLayout>
</template>

<script setup>
import GuestAreaLayout from '../../shared/layouts/GuestAreaLayout.vue';
import HeroSection from '../components/hero/HeroSection.vue';
import OurStorySection from '../components/story/OurStorySection.vue';
import CountdownSection from '../components/countdown/CountdownSection.vue';
import InfoSection from '../components/welcome/WelcomeSection.vue';
import FooterSection from '../components/footer/FooterSection.vue';
import WeddingPartySection from '@/guest_facing/homepage/components/wedding-party/WeddingPartySection.vue';
import AccommodationSection from '@/guest_facing/homepage/components/accommodation/AccommodationSection.vue';
import FaqSection from '@/guest_facing/homepage/components/faq/FaqSection.vue';

</script>
