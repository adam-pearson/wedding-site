<template>
  <Vueform
    size="sm"
    class="space-y-6"
    ref="form$"
    :endpoint="false"
    @submit="submit"
  >
    <TextElement
      input-type="email"
      name="email"
      label="Email Address"
      autocomplete="email"
      :rules="['email', 'required']"
      :debounce="600"
      :columns="{container: 12, label: 12, wrapper: 12}"
    />
    <TextElement
      input-type="password"
      name="password"
      label="Password"
      autocomplete="current-password"
      classes="w-full"
      :rules="['required']"
      :columns="{container: 12, label: 12, wrapper: 12}"
    />
    <ButtonElement
      name="submit"
      button-type="button"
      button-label="Sign In"
      class="mt-4"
      full
      :submits="true"
    />
  </Vueform>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => {},
    },
});

const form$ = ref(null);

const emit = defineEmits(['submit']);

const submit = () => {
    emit('submit', form$.value.requestData);
};

watch(() => props.errors, () => {
    if (Object.keys(props.errors).length === 0) return;

    Object.entries(props.errors).forEach((error) => {
        form$.value.el$(error[0]).messageBag.clear();
        form$.value.el$(error[0]).messageBag.append(error[1]);
    });
});
</script>
