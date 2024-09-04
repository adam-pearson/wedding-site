<template>
  <Vueform
    size="sm"
    v-model="form"
    :endpoint="submit"
  >
    <TextElement
      name="name"
      label="Name"
      :rules="['required']"
      :columns="{
        xs: {container: 12, label: 12, wrapper: 12},
        sm: { container: 6, label: 12, wrapper: 12 }
      }"
    />
    <TextElement
      name="email"
      label="Email Address"
      :rules="['email', 'nullable']"
      :debounce="2000"
      :columns="{
        xs: {container: 12, label: 12, wrapper: 12},
        sm: { container: 6, label: 12, wrapper: 12 }
      }"
    />
    <TextElement
      name="phone"
      label="Phone"
      :columns="{
        xs: {container: 12, label: 12, wrapper: 12},
        sm: { container: 6, label: 12, wrapper: 12 }
      }"
    />
    <TextareaElement
      name="address"
      label="Address"
      :rows="1"
      :columns="{
        xs: {container: 12, label: 12, wrapper: 12},
        sm: { container: 6, label: 12, wrapper: 12 }
      }"
    />
    <RadiogroupElement
      name="plus_one_allowed"
      label="Plus One Allowed"
      view="tabs"
      field-name="plus one allowed"
      info="This guest is allowed to bring one extra guest."
      :rules="['required']"
      :columns="{
        xs: {container: 12, label: 12, wrapper: 12},
        sm: { container: 6, label: 12, wrapper: 12 }
      }"
      :format-data="(n, v) => ({[n]: Boolean(v)})"

      :items="yesNoOptions"
    />

    <RadiogroupElement
      name="is_child"
      label="Guest Is Child?"
      view="tabs"
      field-name="is child"
      info="This guest is a child and will not require an adult meal."
      :rules="['required']"
      :columns="{
        xs: {container: 12, label: 12, wrapper: 12},
        sm: { container: 6, label: 12, wrapper: 12 }
      }"
      :format-data="(n, v) => ({[n]: Boolean(v)})"
      :items="yesNoOptions"
    />
    <RadiogroupElement
      name="guest_type"
      label="Guest Type"
      view="tabs"
      field-name="guest type"
      info="Will this guest receive an all-day, or an evening invitation?"
      :rules="['required']"
      :columns="{
        xs: {container: 12, label: 12, wrapper: 12},
        sm: { container: 6, label: 12, wrapper: 12 },
      }"
      :items="guestTypeOptions"
    />
    <ButtonElement
      name="submit"
      button-label="Submit"
      button-type="button"
      :loading="formSubmitting"
      :submits="true"
      :columns="{container: 12, label: 12, wrapper: 12}"
      full
      add-class="mt-2"
    />
  </Vueform>
</template>

<script setup>
import { reactive, ref } from 'vue';
import useGuestList from '../../composables/guestList';

const guestTypeOptions = [
    { value: 'all_day', label: 'All Day' },
    { value: 'evening', label: 'Evening Only' },
];

const yesNoOptions = [
    { value: 1, label: 'Yes' },
    { value: 0, label: 'No' },
];

const { saveNewGuest } = useGuestList();

const emit = defineEmits(['closeForm', 'submitted']);

const formSubmitting = ref(false);

const form = reactive({});

const submit = async (FormData, form$) => {
    formSubmitting.value = true;
    saveNewGuest(form$.requestData).then(() => {
        formSubmitting.value = false;
        emit('closeForm');
    }).catch(() => {
        formSubmitting.value = false;
    });
};
</script>
