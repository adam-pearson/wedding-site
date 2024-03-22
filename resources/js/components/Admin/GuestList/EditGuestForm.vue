<template>
  <!-- eslint-disable max-len -->
  <Vueform
    size="sm"
    ref="form$"
    :endpoint="false"
    @submit="submit"
  >
    <StaticElement
      name="guest_details_heading"
      tag="div"
      class="pt-4"
    >
      <h2 class="text-lg">
        Guest Details
      </h2>
    </StaticElement>
    <TextElement
      name="name"
      label="Name"
      :value="guest.name"
      :rules="['required']"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextElement
      name="email"
      label="Email"
      input-type="email"
      :rules="['email', 'nullable']"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextElement
      name="phone"
      label="Phone"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextareaElement
      name="address"
      label="Address"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <DateElement
      name="invite_sent_on"
      label="Invite Sent On"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      name="plus_one_allowed"
      label="Plus One Allowed"
      info="This guest is allowed to bring one extra guest"
      :rules="['required']"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      :conditions="[['is_child', 0]]"
      view="tabs"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      name="is_child"
      label="Guest is Child"
      info="This guest is a child and will not require an adult meal"
      :rules="['required']"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      view="tabs"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      name="guest_type"
      label="Guest Type"
      info="Will this guest recieve an all-day or an evening invitation?"
      :rules="['required']"
      :items="[{
        value: 'all_day', label: 'All Day'
      }, {
        value: 'evening', label: 'Evening Only'
      }]"
      view="tabs"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <StaticElement
      name="divider_1"
      tag="hr"
    />
    <StaticElement
      name="invite_details_heading"
      tag="div"
    >
      <h2 class="text-lg">
        Invite Details
      </h2>
    </StaticElement>
    <StaticElement
      name="no_received_invite_div"
      tag="div"
      v-if="!guest.received_invite"
    >
      This guest has not yet RSVP'd.
    </StaticElement>
    <RadiogroupElement
      v-if="guest.received_invite"
      name="coming"
      label="Coming"
      info="Is this guest coming or not?"
      :rules="['required']"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      view="tabs"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      v-if="guest.received_invite"
      name="alcohol"
      label="Alcohol with Meal?"
      info="Is this guest having alcohol with their meal?"
      :rules="['required']"
      :conditions="[['is_child', 0]]"
      :disabled="Boolean(guest.is_child)"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      view="tabs"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextareaElement
      v-if="guest.received_invite"
      name="dietary_requirements"
      label="Dietary Requirements"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <StaticElement
      name="divider_1"
      tag="hr"
    />
    <ButtonElement
      name="cancel"
      button-label="Cancel"
      button-type="button"
      :submits="false"
      @click="emit('finished-editing')"
      :columns="{container: 6, label: 12, wrapper: 12}"
      full
      secondary
    />
    <ButtonElement
      name="submit"
      button-label="Submit"
      button-type="button"
      :submits="true"
      :columns="{container: 6, label: 12, wrapper: 12}"
      full
    />
  </Vueform>

  <!-- eslint-enable max-len -->
</template>

<script setup>
import { ref, onMounted } from 'vue';
import useGuestList from '../../../composables/guestList';

const { updateGuest } = useGuestList();

const emit = defineEmits(['finished-editing']);

const props = defineProps({
    guest: {
        type: Object,
        required: true,
    },
});

const form$ = ref(null);

const submit = () => {
    console.log('submitting: ', form$.value.requestData);
    // updateGuest(props.guest.id, form$.value.requestData);
    // emit('finished-editing');
    /** @TODO - ENSURE FORM ALSO EDITS RECEIVED_INVITES TABLE */
    /** @TODO - ENSURE FORM EDITS MAIN GUEST IF PLUS ONE GUEST TYPE IS EDITED AND VICE VERSA */
};

onMounted(() => {
    console.log(props.guest);
    form$.value.update({
        name: props.guest.name,
        email: props.guest.email,
        phone: props.guest.phone,
        address: props.guest.address,
        plus_one_allowed: props.guest.plus_one_allowed,
        is_child: props.guest.is_child,
        guest_type: props.guest.guest_type,
        invite_sent_on: props.guest.invite_sent_on,
        coming: props.guest.received_invite?.coming,
        alcohol: props.guest.received_invite?.alcohol,
        dietary_requirements: props.guest.received_invite?.dietary_requirements,
    });
});
</script>
