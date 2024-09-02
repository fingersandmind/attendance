<script setup>

import SidebarItem from "@/Layouts/Dashboard/SidebarItem.vue";
import HomeIcon from "@/Components/Icons/HomeIcon.vue"
import UsersIcon from "@/Components/Icons/UsersIcon.vue"
import UserIcon from "@/Components/Icons/UserIcon.vue"
import StatisticIcon from "@/Components/Icons/StatisticIcon.vue"
import CogIcon from "@/Components/Icons/CogIcon.vue";
import {usePage} from "@inertiajs/vue3";
import { computed } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
    isSideMenuOpen: {
        type: Boolean,
        required: true
    }
})

defineEmits(['toggleSideMenu', 'closeSideMenu']);

const menuItems = [
    {
        name: 'Dashboard',
        icon: HomeIcon,
        active: route().current('admin.home'),
        to: { name: 'admin.home' }
    },
    {
        name: 'Manage Admin',
        icon: UsersIcon,
        active: route().current('admin.users.*'),
        to: { name: 'admin.users.index' }
    },
    {
        name: 'Faculties',
        icon: UserIcon,
        active: route().current('admin.faculties.*') || route().current('admin.logs.*'),
        to: { name: 'admin.faculties.index' }
    },
    {
        name: 'Settings',
        icon: CogIcon,
        active: route().current('admin.settings.*'),
        to: { name: 'admin.settings.index' }
    },
    {
        name: 'Reports',
        icon: StatisticIcon,
        active: route().current('admin.reports'),
        to: { name: 'admin.reports' }
    },
]

const user = computed(() => usePage().props.auth.user)

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="">
        <aside class="relative z-40 md:hidden" role="dialog" aria-modal="true">
            <div v-if="isSideMenuOpen" class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

            <div class="fixed inset-0 z-40 flex">
                <div v-show="isSideMenuOpen" class="relative flex flex-col flex-1 w-full max-w-xs bg-gray-800">
                    <!--
                      Close button, show/hide based on off-canvas menu state.

                      Entering: "ease-in-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "ease-in-out duration-300"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
                    <div class="absolute top-0 right-0 pt-2 -mr-12">
                        <button type="button"
                                @click="$event => $emit('closeSideMenu')"
                                @keyup.esc="$event => $emit('closeSideMenu')"
                                class="flex items-center justify-center w-10 h-10 ml-1 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <img class="w-auto h-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                        </div>
                        <nav class="px-2 mt-5 space-y-1">
                            <SidebarItem
                                v-for="item in menuItems"
                                :key="item.name"
                                :menu="item"
                            />
                        </nav>
                    </div>
                    <div class="flex flex-shrink-0 p-4 bg-gray-700">
                        <a href="#" class="flex-shrink-0 block group">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-base font-medium text-white">{{ user.name }}</p>
                                    <p class="text-sm font-medium text-gray-400 sr-only group-hover:text-gray-300">View profile</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div
                    @click="$event => $emit('toggleSideMenu')"
                    class="flex-shrink-0 h-12 w-14">
                    <!-- Force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </aside>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex flex-col flex-1 min-h-0 bg-gray-800">
                <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img class="w-auto h-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </div>
                    <nav class="flex-1 px-2 mt-5 space-y-1">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <SidebarItem
                            v-for="item in menuItems"
                            :key="item.name"
                            :menu="item"
                        />
                    </nav>
                </div>
                <div class="flex flex-shrink-0 p-4 bg-gray-700">
                    <a href="#" class="flex-shrink-0 block w-full group">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block rounded-full h-9 w-9" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white">{{ user.name }}</p>
                                    <p class="text-xs font-medium text-gray-300 sr-only group-hover:text-gray-200">View profile</p>
                                </div>
                            </div>
                            <form @submit.prevent="logout" class="inline">
                                <button type="submit" class="right-0 text-sm text-gray-200 hover:text-gray-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
