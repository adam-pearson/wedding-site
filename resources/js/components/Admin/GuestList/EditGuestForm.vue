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
      :rules="['required']"
      :readonly="!editing"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextElement
      name="email"
      label="Email"
      input-type="email"
      :rules="['email', 'nullable']"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :disabled="guestIsPlusOne"
      :readonly="!editing"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextElement
      name="phone"
      label="Phone"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :disabled="guestIsPlusOne"
      :readonly="!editing"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextareaElement
      name="address"
      label="Address"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :disabled="guestIsPlusOne"
      :readonly="!editing"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <DateElement
      name="invite_sent_on"
      label="Invite Sent On"
      :disabled="guestIsPlusOne"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :readonly="!editing"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      name="plus_one_allowed"
      label="Plus One Allowed"
      info="This guest is allowed to bring one extra guest"
      view="tabs"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :disabled="!editing || guestIsPlusOne"
      :rules="['required']"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      :conditions="[['is_child', 0]]"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      name="is_child"
      label="Guest is Child"
      info="This guest is a child and will not require an adult meal"
      view="tabs"
      :disabled="!editing || guestIsPlusOne"
      :rules="['required']"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      name="guest_type"
      label="Guest Type"
      info="Will this guest recieve an all-day or an evening invitation?"
      view="tabs"
      :disabled="!editing || guestIsPlusOne"
      :rules="['required']"
      :items="[{
        value: 'all_day', label: 'All Day'
      }, {
        value: 'evening', label: 'Evening Only'
      }]"
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
      view="tabs"
      :disabled="!editing || guestIsPlusOne"
      :rules="['required']"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <RadiogroupElement
      v-if="guest.received_invite"
      name="alcohol"
      label="Alcohol with Meal?"
      info="Is this guest having alcohol with their meal?"
      view="tabs"
      :disabled="!editing || Boolean(guest.is_child)"
      :conditions="[['guest_type', 'all_day']]"
      :rules="['required']"
      :items="[{
        value: 1, label: 'Yes'
      }, {
        value: 0, label: 'No'
      }]"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextareaElement
      v-if="guest.received_invite"
      name="dietary_requirements"
      label="Dietary Requirements"
      :readonly="!editing"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <StaticElement
      v-if="editing"
      name="divider_1"
      tag="hr"
    />
    <ButtonElement
      v-if="editing"
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
      v-if="editing"
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
import {
    ref, onMounted, watch, computed,
} from 'vue';
import useGuestList from '../../../composables/guestList';

const { saveNewGuest, updateGuest } = useGuestList();

const emit = defineEmits(['finished-editing']);

const props = defineProps({
    addingPlusOne: {
        type: Boolean,
        required: true,
    },
    editing: {
        type: Boolean,
        required: true,
    },
    guest: {
        type: Object,
        required: true,
    },
});

const guestIsPlusOne = computed(() => props.guest.plus_one_of !== null || props.addingPlusOne);

const form$ = ref(null);

const submit = () => {
    if (props.addingPlusOne) {
        saveNewGuest(form$.value.requestData, props.guest.id);
    } else {
        updateGuest(props.guest.id, form$.value.requestData);
    }
    emit('finished-editing');
    /** @TODO - ENSURE FORM ALSO EDITS RECEIVED_INVITES TABLE */
    /** @TODO - ENSURE FORM EDITS MAIN GUEST IF PLUS ONE GUEST TYPE IS EDITED AND VICE VERSA */
};

const updateFormValues = (guestVals) => {
    form$.value.update({
        name: guestVals.name,
        email: guestVals.email,
        phone: guestVals.phone,
        address: guestVals.address,
        plus_one_allowed: guestVals.plus_one_allowed,
        is_child: guestVals.is_child,
        guest_type: guestVals.guest_type,
        invite_sent_on: guestVals.invite_sent_on,
        coming: guestVals.received_invite?.coming,
        alcohol: guestVals.received_invite?.alcohol,
        dietary_requirements: guestVals.received_invite?.dietary_requirements,
    });
};

onMounted(() => {
    if (props.addingPlusOne) {
        const newPlusOneVals = {
            name: null,
            email: null,
            phone: null,
            address: null,
            plus_one_allowed: false,
            is_child: false,
            guest_type: props.guest.guest_type,
            invite_sent_on: null,
            coming: props.guest.received_invite?.coming,
            alcohol: null,
            dietary_requirements: null,
        };
        updateFormValues(newPlusOneVals);
    } else {
        updateFormValues(props.guest);
    }
});

watch(() => props.guest, (guestVals) => {
    console.log('guestVals: ', guestVals);
    if (!props.addingPlusOne) {
        updateFormValues(guestVals);
    }
}, { deep: true });

watch(() => props.addingPlusOne, (newVal) => {
    console.log('adding plus one: ', newVal);
    if (newVal) {
        const newPlusOneVals = {
            name: null,
            email: null,
            phone: null,
            address: null,
            plus_one_allowed: false,
            is_child: false,
            guest_type: props.guest.guest_type,
            invite_sent_on: null,
            coming: props.guest.received_invite?.coming,
            alcohol: null,
            dietary_requirements: null,
        };
        updateFormValues(newPlusOneVals);
    }
});
</script>
