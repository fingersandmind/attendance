<template>
    <div class="flex flex-col min-h-screen bg-gray-100">
      <!-- Header -->
      <header class="bg-white shadow-md">
        <div class="flex items-center justify-between px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold text-gray-900">Attendance System</h1>
          <div v-if="!authenticated">
            <a
                :href="route('login')"
                class="px-4 py-2 text-white transition duration-150 bg-blue-500 rounded-md hover:bg-blue-600">
                Login
            </a>
          </div>
        </div>
      </header>
  
      <slot/>
  
      <!-- Footer -->
      <footer class="py-4 text-white bg-gray-800">
        <div class="mx-auto text-center max-w-7xl">
          © 2024 Attendance System. All rights reserved.
        </div>
      </footer>
    </div>
  </template>
  
<script setup>
  import { ref } from 'vue';
  import { usePage } from '@inertiajs/vue3';

  const { props } = usePage();
  const authenticated = ref(props.auth?.user !== null);
</script>

<style scoped>
/* Add any additional styles if needed */
</style>
  