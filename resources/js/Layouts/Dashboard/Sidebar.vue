<script setup>

import SidebarItem from "@/Layouts/Dashboard/SidebarItem.vue";
import HomeIcon from "@/Components/Icons/HomeIcon.vue"
import UsersIcon from "@/Components/Icons/UsersIcon.vue"
import UserIcon from "@/Components/Icons/UserIcon.vue"
import StatisticIcon from "@/Components/Icons/StatisticIcon.vue"
import CogIcon from "@/Components/Icons/CogIcon.vue";
import {usePage} from "@inertiajs/vue3";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

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
        active: false,
        to: ""
    },
    {
        name: 'Manage Admin',
        icon: UsersIcon,
        active: route().current('admin.users.*'),
        to: { name: 'admin.users.index' }
    },
    {
        name: 'Faculty',
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
</script>

<template>
    <div class="">
        <aside class="relative z-40 md:hidden" role="dialog" aria-modal="true">
            <div v-if="isSideMenuOpen" class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

            <div class="fixed inset-0 z-40 flex">
                <div v-show="isSideMenuOpen" class="relative flex w-full max-w-xs flex-1 flex-col bg-gray-800">
                    <!--
                      Close button, show/hide based on off-canvas menu state.

                      Entering: "ease-in-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "ease-in-out duration-300"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button type="button"
                                @click="$event => $emit('closeSideMenu')"
                                @keyup.esc="$event => $emit('closeSideMenu')"
                                class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="h-0 flex-1 overflow-y-auto pt-5 pb-4">
                        <div class="flex flex-shrink-0 items-center px-4">
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                        </div>
                        <nav class="mt-5 space-y-1 px-2">
                            <SidebarItem
                                v-for="item in menuItems"
                                :key="item.name"
                                :menu="item"
                            />
                        </nav>
                    </div>
                    <div class="flex flex-shrink-0 bg-gray-700 p-4">
                        <a href="#" class="group block flex-shrink-0">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-base font-medium text-white">{{ user.name }}</p>
                                    <p class="text-sm font-medium text-gray-400 group-hover:text-gray-300 sr-only">View profile</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div
                    @click="$event => $emit('toggleSideMenu')"
                    class="w-14 h-12 flex-shrink-0">
                    <!-- Force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </aside>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex min-h-0 flex-1 flex-col bg-gray-800">
                <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
                    <div class="flex flex-shrink-0 items-center px-4">
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </div>
                    <nav class="mt-5 flex-1 space-y-1 px-2">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <SidebarItem
                            v-for="item in menuItems"
                            :key="item.name"
                            :menu="item"
                        />
                    </nav>
                </div>
                <div class="flex flex-shrink-0 bg-gray-700 p-4">
                    <a href="#" class="group block w-full flex-shrink-0">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block h-9 w-9 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white">{{ user.name }}</p>
                                    <p class="text-xs font-medium text-gray-300 group-hover:text-gray-200 sr-only">View profile</p>
                                </div>
                            </div>
                            <Link
                                :href="route('logout')"
                                method="POST"
                                class="text-gray-200 text-sm right-0 hover:text-gray-300"
                            >
                                Logout
                            </Link>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
