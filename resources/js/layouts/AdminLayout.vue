<template>
    <!-- eslint-disable max-len -->
    <AdminSidebar />
    <div>
        <main class="lg:pl-72">
            <div class="xl:pl-96">
                <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
                    <slot></slot>
                </div>
            </div>
        </main>
    </div>
    <!-- eslint-enable max-len -->
</template>

<script setup>
import AdminSidebar from '../components/Admin/AdminSidebar.vue';
</script>
