<template>
  <!-- eslint-disable max-len -->
  <div
    class="absolute z-50 flex size-full items-center justify-center backdrop-blur-sm transition duration-150"
  >
    <div
      class="text-surface inline-block size-8 animate-spin rounded-full border-4 border-solid border-current border-e-transparent align-[-0.125em] text-amber-500 motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"
      role="status"
    >
      <span
        class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Loading...</span>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>
