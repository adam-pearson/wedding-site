<template>
  <!-- eslint-disable max-len -->
  <div
    id="accommodation"
    class="flex w-full flex-col items-center justify-center gap-0 bg-white px-4 py-16 md:gap-4 md:py-16 lg:px-32 "
  >
    <h3
      class="text-center font-script text-4xl text-primary-500"
      v-motion
      :initial="{opacity: 0}"
      :visible-once="
        {
          opacity: 1,
          transition: {
            ease: 'easeInOut',
            duration: 1200,
            delay: 200,
          }
        } "
    >
      Accommodation Suggestions
    </h3>
    <p
      class="w-full text-center font-serif text-gray-600 md:w-3/5"
      v-motion
      :initial="{opacity: 0}"
      :visible-once="
        {
          opacity: 1,
          transition: {
            ease: 'easeInOut',
            duration: 1200,
            delay: 400,
          }
        } "
    >
      As the venue only has limited rooms, these have already been allocated to close family & guests travelling from afar. If you would like lodging for the night, below are a few suggestions for hotels nearby, all within a short taxi ride from the venue.
    </p>
    <div class="mx-auto mt-8 grid max-w-2xl grid-cols-1 gap-8 md:grid-cols-2 lg:mx-0 lg:max-w-none xl:grid-cols-4">
      <a
        target="_blank"
        :href="hotel.website"
        class="group block divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow transition-all duration-300 hover:translate-y-1/2 hover:shadow-lg"
        v-for="(hotel, index) in hotels"
        :key="hotel.name"
        v-motion
        :initial="{opacity: 0, y: 50}"
        :visible-once="
          {
            opacity: 1,
            y: 0,
            transition: {
              ease: 'easeInOut',
              duration: 1200,
              delay: 200 + (index * 100),
            }
          } "
      >
        <div class="overflow-hidden">
          <img
            class="w-full object-cover transition duration-300 group-hover:scale-110"
            :src="hotel.imageUrl"
            :alt="hotel.name"
          >
        </div>
        <div class="items-between flex flex-col justify-between gap-2 p-4 text-left sm:px-6">
          <div class="h-full">
            <h3 class="font-serif text-xl text-gray-700">
              {{ hotel.name }}
            </h3>
            <p class="text-xs text-gray-600">
              {{ hotel.address }}
            </p>
          </div>
          <div>
            <p class="text-sm text-gray-600">
              {{ hotel.distance }}
            </p>
          </div>
        </div>
      </a>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>

const hotels = [
    {
        name: 'The Tickled Trout',
        address: 'Preston New Road, Samlesbury, Preston, PR5 0UJ',
        phone: '0344 879 9053',
        website: 'https://www.macdonaldhotels.co.uk/tickled-trout',
        imageUrl: '/images/tickled_trout.webp',
        distance: '2.8 miles',
    },
    {
        name: 'Samlesbury Hotel',
        address: 'Preston New Road, Samlesbury, Preston, PR5 0UL',
        phone: '01772 868000',
        website: 'https://www.samlesburyhotel.co.uk/',
        imageUrl: '/images/samlesbury.webp',
        distance: '2.4 miles',
    },
    {
        name: 'Holiday Inn Express Preston South',
        address: 'Reedfield Place, Walton Summit, Bamber Bridge, Preston, PR5 8AA',
        phone: '00800 80 80 0800',
        website: 'https://www.ihg.com/holidayinnexpress/hotels/gb/en/preston/xptps/hoteldetail',
        imageUrl: '/images/holiday_inn.webp',
        distance: '4.0 miles',
    },
    {
        name: 'Premier Inn Preston South',
        address: 'Craven Drive, Bamber Bridge, Preston, PR5 6BZ',
        phone: '0333 321 8339',
        website: 'https://www.premierinn.com/gb/en/hotels/england/lancashire/preston/preston-south-craven-drive.html?cid=GLBC_PREBAR',
        imageUrl: '/images/premier_inn.webp',
        distance: '4.9 miles',
    },
];
</script>
