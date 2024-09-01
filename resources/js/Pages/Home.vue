<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const { props } = usePage();
  
  // Assume user is not authenticated (for demonstration purposes)
const authenticated = ref(props.is_authenticated);

// Function to handle login (replace with actual login logic)
const login = () => {
    console.log(route('login'));
    router.visit(route('login'))
};
</script>

<template>
    <BaseLayout>
        <!-- Hero Section -->
      <section class="flex items-center justify-center flex-1 bg-blue-100">
        <div class="px-4 text-center">
          <h2 class="mb-4 text-4xl font-extrabold text-gray-900">
            Simplify Your Attendance Management
          </h2>
          <p class="mb-8 text-lg text-gray-700">
            Track, manage, and analyze attendance data in one place. Secure and easy to use.
          </p>
          <div v-if="!authenticated">
            <a
                :href="route('login')"
                @click="login"
                class="px-6 py-3 text-lg font-semibold text-white transition duration-150 bg-blue-500 rounded-md hover:bg-blue-600">
                Get Started
            </a>
          </div>
        </div>
      </section>
  
      <!-- Features Section -->
      <section class="py-12 bg-white">
        <div class="grid grid-cols-1 gap-8 px-4 mx-auto max-w-7xl md:grid-cols-3">
          <div class="text-center">
            <div class="mb-4">
              <svg class="w-12 h-12 mx-auto text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5 3v2h14V3h2v18H3V3h2zm2 6v2h10V9H7zm0 4v2h10v-2H7zm0 4v2h6v-2H7z"></path>
              </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900">Comprehensive Reports</h3>
            <p class="text-gray-600">
              Generate detailed attendance reports with just a few clicks.
            </p>
          </div>
          <div class="text-center">
            <div class="mb-4">
              <svg class="w-12 h-12 mx-auto text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.97 0 5.33-2.33 5.33-5.22C17.33 4.34 14.97 2 12 2c-2.97 0-5.33 2.34-5.33 5.22C6.67 9.67 9.03 12 12 12zm0 1.25c-2.67 0-8 1.33-8 4v2h16v-2c0-2.67-5.33-4-8-4z"></path>
              </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900">User Management</h3>
            <p class="text-gray-600">
              Easily manage users and track their attendance data.
            </p>
          </div>
          <div class="text-center">
            <div class="mb-4">
              <svg class="w-12 h-12 mx-auto text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 4v2h18V4H3zm0 4v2h18V8H3zm0 4v2h18v-2H3zm0 4v2h18v-2H3zm0 4v2h18v-2H3z"></path>
              </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900">Secure & Reliable</h3>
            <p class="text-gray-600">
              Rest assured that your data is safe and protected at all times.
            </p>
          </div>
        </div>
      </section>
    </BaseLayout>
</template>
