<script setup>
import Sidebar from "@/Layouts/Dashboard/Sidebar.vue";
import { ref } from "vue";
import HamburgerIcon from "@/Components/Icons/HamburgerIcon.vue";

const isSideMenueOpen = ref(false);
const toggleSideMenu = () => {
    isSideMenueOpen.value = ! isSideMenueOpen.value;
}

const closeSideMenu = () => {
    isSideMenueOpen.value = false;
}
</script>

<template>
    <div>
        <Sidebar
            :is-side-menu-open="isSideMenueOpen"
            @toggle-side-menu="toggleSideMenu"
            @close-side-menu="closeSideMenu"
        />
        <div class="flex flex-col flex-1 md:pl-64">
            <div class="sticky top-0 z-10 pt-1 pl-1 bg-gray-100 sm:pl-3 sm:pt-3 md:hidden">
                <button type="button"
                        class="-ml-0.5 -mt-0.5 inline-flex h-12 w-12 items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Open sidebar</span>
                    <HamburgerIcon />
                </button>
            </div>
            <main class="flex-1">
                <div class="px-4 py-6">
                    <slot/>
                </div>
            </main>
        </div>
    </div>

</template>
