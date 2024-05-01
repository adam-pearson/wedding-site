<template>
  <!-- eslint-disable max-len -->
  <p class="font-serif text-2xl font-semibold text-primary-500">
    {{ guest.name }}
  </p>
  <h2 class="font-serif text-2xl font-semibold leading-7 text-primary-500">
    RSVP
  </h2>
  <p class="mt-1 text-sm leading-6 text-gray-500">
    Please use the form below to RSVP to our wedding.
  </p>
  <div class="flex w-full justify-center py-4">
    <Vueform
      size="sm"
      ref="form$"
      class="w-full"
      :debounce="500"
      :endpoint="false"
      @submit="submit"
    >
      <RadiogroupElement
        name="coming"
        label="Are you coming?"
        :rules="['required']"
        :items="[{value: 1, label: 'Yes'}, {value: 0, label: 'No'}]"
        view="tabs"
      />
      <TextElement
        name="email"
        label="Email"
        input-type="email"
        :rules="['email', 'nullable']"
        :value="guest.email"
        :conditions="[['coming', 1]]"
      />
      <TextElement
        name="phone"
        label="Phone"
        :rules="['nullable']"
        :value="guest.email"
        :conditions="[['coming', 1]]"
      />
      <RadiogroupElement
        v-if="guest.guest_type === GUEST_TYPES.ALL_DAY.value && !guest.is_child"
        name="alcohol"
        label="Would you like alcohol with your meal?"
        view="tabs"
        :rules="['required']"
        :items="[{value: 1, label: 'Yes'}, {value: 0, label: 'No'}]"
        :value="guest.is_child ? 0 : 1"
        :disabled="guest.is_child ? true : false"
        :conditions="[['coming', 1]]"
      />
      <TextareaElement
        v-if="guest.guest_type === GUEST_TYPES.ALL_DAY.value"
        name="dietary_requirements"
        label="Do you have any dietary requirements?"
        :conditions="[['coming', 1]]"
      />
      <TextElement
        name="song_request"
        label="Do you have a song request?"
        :rules="['nullable']"
        :value="guest.song_request"
        :conditions="[['coming', 1]]"
      />
      <RadiogroupElement
        v-if="guest.plus_one_allowed"
        name="using_plus_one"
        label="Would you like to bring a plus one?"
        :rules="['required']"
        :items="[{value: 1, label: 'Yes'}, {value: 0, label: 'No'}]"
        view="tabs"
        :conditions="[['coming', 1]]"
      />
      <TextElement
        v-if="guest.plus_one_allowed"
        name="plus_one_name"
        label="Plus One's Name"
        :rules="['required']"
        :value="guest.email"
        :conditions="[['coming', 1], ['using_plus_one', 1]]"
      />
      <RadiogroupElement
        v-if="guest.plus_one_allowed && guest.guest_type === GUEST_TYPES.ALL_DAY.value"
        name="plus_one_alcohol"
        label="Would your plus one like alcohol with their meal?"
        :rules="['required']"
        :items="[{value: 1, label: 'Yes'}, {value: 0, label: 'No'}]"
        view="tabs"
        :conditions="[['coming', 1], ['using_plus_one', 1]]"
      />
      <TextareaElement
        v-if="guest.plus_one_allowed && guest.guest_type === GUEST_TYPES.ALL_DAY.value"
        name="plus_one_dietary_requirements"
        label="Does your plus one have any dietary requirements?"
        :rules="['nullable']"
        :conditions="[['coming', 1], ['using_plus_one', 1]]"
      />
      <ButtonElement
        name="submit"
        button-label="Submit"
        full
        class="mt-4"
        :submits="true"
      />
    </Vueform>
  </div>
  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref } from 'vue';
import useGuest from '../../../../shared/composables/guest';
import GUEST_TYPES from '../../../../shared/constants/guestTypes';

const { guest } = useGuest();

const form$ = ref(null);

const emit = defineEmits(['submit']);

const submit = () => {
    emit('submit', { guest_code: guest.value.unique_code, formData: form$.value.requestData });
};
</script>
