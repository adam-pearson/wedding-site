<template>
  <!-- eslint-disable max-len -->
  <div
    class="w-full h-full backdrop-blur-sm absolute flex items-center justify-center transition duration-150 z-50"
  >
    <div
      class="inline-block h-8 w-8 animate-spin rounded-full text-amber-500 border-4 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"
      role="status"
    >
      <span
        class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Loading...</span>
    </div>
  </div>
  <!-- eslint-enable max-len -->
</template>
