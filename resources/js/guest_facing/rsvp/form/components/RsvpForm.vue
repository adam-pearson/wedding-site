<template>
  <!-- eslint-disable max-len -->
  <div class="w-full">
    <Vueform
      @submit="handleSubmit"
      ref="form$"
      :endpoint="false"
      v-motion
      :initial="{opacity: 0}"
      :visible-once="
        {
          opacity: 1,
          transition: {
            ease: 'easeInOut',
            duration: 600,
          }
        } "
    >
      >
      <template #empty>
        <FormSteps class="hidden">
          <FormStep
            name="coming"
            :rules="['required']"
            :elements="['coming']"
          />
          <FormStep
            name="contact_details"
            :elements="['email', 'phone']"
            :conditions="[
              ['coming', true],
              function () {
                return !guest.is_child;
              }
            ]"
          />
          <FormStep
            name="main_guest_meal"
            :elements="['alcohol', 'dietary_requirements']"
            :conditions="[['coming', true]]"
          />
          <FormStep
            name="song_requests"
            :elements="['song_requests', 'hated_songs']"
            :conditions="[['coming', true], function () {
              return !guest.is_child;
            }]"
          />
          <FormStep
            name="additional_guests"
            :elements="['bringing_plus_one']"
            :conditions="[
              ['coming', true],
              function () {
                return guest.plus_one_allowed;
              }]"
          />
          <FormStep
            name="additional_guests_details"
            :elements="['plus_one_name', 'plus_one_alcohol', 'plus_one_dietary_requirements']"
            :conditions="[
              ['coming', true],
              ['bringing_plus_one', true]]"
          />
        </FormSteps>

        <FormElements>
          <RadiogroupElement
            name="coming"
            label="Will you be attending?"
            :view="'tabs'"
            :rules="['required']"
            :items="[
              { value: 1, label: 'Yes' },
              { value: 0, label: 'No' },
            ]"
            :format-data="(n, v) => ({[n]: v === null ? null : Boolean(v)})"
          />
          <TextElement
            name="email"
            label="Email Address (optional)"
            :rules="['nullable', 'email']"
            :debounce="200"
            :conditions="[
              function () {
                return !guest.is_child;
              }
            ]"
          />
          <TextElement
            name="phone"
            label="Phone (optional)"
            :conditions="[
              function () {
                return !guest.is_child;
              }
            ]"
          />
          <RadiogroupElement
            name="alcohol"
            label="Would you like alcoholic or non-alcoholic drinks with your meal?"
            view="tabs"
            :rules="['required']"
            :items="[
              {value: 1, label: 'Alcoholic'},
              {value: 0, label: 'Non-Alcoholic'}
            ]"
            :value="guest.is_child ? 0 : 1"
            :disabled="!!guest.is_child"
            :conditions="[
              function () {
                return guest.guest_type === GUEST_TYPES.ALL_DAY.value && !guest.is_child;
              }
            ]"
          />
          <TextareaElement
            name="dietary_requirements"
            label="Do you have any dietary requirements we should know about?"
            :rules="['nullable']"
          />
          <TextElement
            name="song_requests"
            label="What song(s) would get you up on the dance floor?"
            :rules="['nullable']"
          />
          <TextElement
            name="hated_songs"
            label="Are there any songs you absolutely can't stand?"
            :rules="['nullable']"
          />
          <RadiogroupElement
            name="bringing_plus_one"
            label="Would you like to bring a plus one?"
            :view="'tabs'"
            :rules="['required']"
            :items="[
              { value: 1, label: 'Yes' },
              { value: 0, label: 'No' },
            ]"
            :format-data="(n, v) => ({[n]: v === null ? null : Boolean(v)})"
          />
          <TextElement
            name="plus_one_name"
            label="What is the name of your plus one?"
            :rules="['required']"
          />
          <RadiogroupElement
            name="plus_one_alcohol"
            label="Would your plus one like alcoholic or non-alcoholic drinks with their meal?"
            view="tabs"
            :rules="['required']"
            :items="[
              {value: 1, label: 'Alcoholic'},
              {value: 0, label: 'Non-Alcoholic'}
            ]"
            :conditions="[
              function () {
                return guest.guest_type === GUEST_TYPES.ALL_DAY.value;
              }
            ]"
          />
          <TextareaElement
            name="plus_one_dietary_requirements"
            label="Does your plus one have any dietary requirements we should know about?"
            :rules="['nullable']"
          />
        </FormElements>
        <FormStepsControls
          v-if="form$?.requestData.coming !== null"
          v-motion
          :initial="{opacity: 0}"
          :visible-once="
            {
              opacity: 1,
              transition: {
                ease: 'easeInOut',
                duration: 600,
              }
            } "
        />
      </template>
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

const handleSubmit = (form) => {
    emit('submit', form.requestData);
};
</script>
