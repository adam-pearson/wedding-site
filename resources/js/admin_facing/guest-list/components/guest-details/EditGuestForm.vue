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
    <DateElement
      name="save_the_date_sent_on"
      label="Save the Date Sent On"
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
    <TagsElement
      name="group"
      label="Group"
      :disabled="!editing || guestIsPlusOne"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :readonly="!editing"
      :create="true"
      :max="1"
      :format-data="(n, v) => ({[n]: formatGroupData(v) })"
      :items="async function () {
        await loadGroups();
        return groups.map((group) => ({
          value: group.id,
          label: group.group_name,
        }));
      }"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
      @change="handleGroupChanged()"
    />
    <TagsElement
      name="group_members"
      label="Group Members"
      :disabled="!editing || guestIsPlusOne"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :readonly="!editing"
      :search="true"
      :items="guestList.map((guest) => ({
        value: guest.id,
        label: guest.name,
      }))"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <StaticElement
      name="divider_1"
      tag="hr"
      class="py-2"
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
      v-if="!guest.rsvp_response"
    >
      This guest has not yet RSVP'd.
    </StaticElement>
    <RadiogroupElement
      v-if="guest.rsvp_response"
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
      v-if="guest.rsvp_response"
      name="alcohol"
      label="Alcohol with Meal?"
      info="Is this guest having alcohol with their meal?"
      view="tabs"
      :disabled="!editing || Boolean(guest.is_child)"
      :conditions="[['guest_type', 'all_day'], ['coming', 1], ['is_child', 0]]"
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
      v-if="guest.rsvp_response"
      name="dietary_requirements"
      label="Dietary Requirements"
      :readonly="!editing"
      :conditions="[['coming', 1]]"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextElement
      name="song_requests"
      label="Song Requests?"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :conditions="[['coming', 1]]"
      :disabled="guestIsPlusOne"
      :readonly="!editing"
      :columns="{
        container: 12, label: 3, wrapper: 12
      }"
    />
    <TextElement
      name="hated_songs"
      label="Hated Songs?"
      :placeholder="guestIsPlusOne ? 'N/A' : ''"
      :conditions="[['coming', 1]]"
      :disabled="guestIsPlusOne"
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
import useGuestList from '../../composables/guestList';

const {
    guestList, saveNewGuest, updateGuest, getGuestListForSelectWithoutCurrentGuest, groups, loadGroups,
} = useGuestList();

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

const formatGroupData = (group) => {
    if (group[0]) {
        // check if group[0] is an int - this means we have an existing group
        if (parseInt(group[0], 10)) {
            const existingGroup = groups.value?.find((g) => g.id === parseInt(group[0], 10));
            return { id: existingGroup?.id, group_name: existingGroup?.group_name };
        }
        return { id: null, group_name: group[0] };
    }
    return null;
};
const submit = () => {
    if (props.addingPlusOne) {
        saveNewGuest(form$.value.requestData, props.guest.id);
    } else {
        updateGuest(props.guest.id, form$.value.requestData);
    }
    emit('finished-editing');
};

const handleGroupChanged = () => {
    const newValue = form$.value.el$('group').value[0];

    if (newValue !== undefined) {
        const ids = guestList.value
            .filter((guest) => guest.group_id === parseInt(newValue, 10))
            .map((guest) => guest.id);

        const currentGuestId = props.guest.id;

        const filteredIds = ids.filter((id) => id !== currentGuestId);
        filteredIds.unshift(currentGuestId);
        form$.value.el$('group_members').update(filteredIds);
    } else {
        form$.value.el$('group_members').update([]);
    }
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
        save_the_date_sent_on: guestVals.save_the_date_sent_on,
        coming: guestVals.rsvp_response?.coming,
        alcohol: guestVals.rsvp_response?.alcohol,
        dietary_requirements: guestVals.rsvp_response?.dietary_requirements,
        song_requests: guestVals.rsvp_response?.song_requests,
        hated_songs: guestVals.rsvp_response?.hated_songs,
        group: [guestVals.group_id],
        group_members: guestVals.group?.guests?.map((guest) => guest.id),
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
            save_the_date_sent_on: null,
            coming: props.guest.rsvp_response?.coming,
            alcohol: null,
            dietary_requirements: null,
            song_requests: null,
            hated_songs: null,
        };
        updateFormValues(newPlusOneVals);
    } else {
        updateFormValues(props.guest);
    }
});

watch(() => props.guest, (guestVals) => {
    if (!props.addingPlusOne) {
        updateFormValues(guestVals);
    }
}, { deep: true });

watch(() => props.addingPlusOne, (newVal) => {
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
            save_the_date_sent_on: null,
            coming: props.guest.rsvp_response?.coming,
            alcohol: null,
            dietary_requirements: null,
            song_requests: null,
            hated_songs: null,
        };
        updateFormValues(newPlusOneVals);
    }
});
</script>
