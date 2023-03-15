<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import { Link } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination/Pagination.vue";
import Dropdown from "@/Components/Dropdown/Dropdown.vue";
import DropdownLink from "@/Components/Dropdown/DropdownLink.vue";
import BaseButton from "@/Components/Buttons/BaseButton.vue";
import EllipsisVertical from "@/Components/Icons/EllipsisVertical.vue";
import {ref} from "vue";
import { router } from "@inertiajs/vue3";
import InputLabel from "@/Components/Inputs/InputLabel.vue";

let props = defineProps({
    users: {
        type: Object,
        required: false
    },
    breadcrumbs: Object
});
const searchTerm = ref('');

let search = async (page = 1) => {
    await router.visit(
        route('admin.users.index'),
        {
            data: {
                searchTerm: searchTerm.value,
                page: page,
            },
            preserveScroll: true
        }
    )
}

</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Admins</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the Users who can access the page</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <Link
                        type="button"
                        class="block rounded-md bg-indigo-600 py-1.5 px-3 text-center text-sm font-semibold
                            leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline
                            focus-visible:outline-2 focus-visible:outline-offset-2
                            focus-visible:outline-indigo-600"
                        :href="route('admin.users.create')"
                    >
                        Add
                    </Link>
                </div>
            </div>
            <div class="flex justify-start mt-4">
                <div>
                    <InputLabel
                        for="search"
                        value="Search"
                    />
                    <div class="relative mt-2 flex items-center">
                        <input
                            type="text"
                            name="search"
                            id="search"
                            placeholder="Search for names.."
                            v-model="searchTerm"
                            @change="search(1)"
                            class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        >
                        <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                            <kbd class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     class="w-4 h-4 rotate-180">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                </svg>
                            </kbd>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 flow-root">
                <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table
                                v-if="props.users.data.length > 0"
                                class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">
                                        Email
                                    </th>
                                    <th
                                        scope="col"
                                        class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="user in props.users.data"
                                    :key="user.id"
                                >
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ user.name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ user.email }}
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <Dropdown>
                                            <template #trigger>
                                                <BaseButton
                                                    variant="normal"
                                                    type="button"
                                                    class="!p-0 !mx-auto">
                                                    <EllipsisVertical />
                                                </BaseButton>
                                            </template>

                                            <template #content>
                                                <DropdownLink
                                                    :href="route('admin.users.show', { user: user.id })"
                                                >
                                            <span
                                                class="text-dark-gray-500 text-md font-normal">
                                                Details
                                            </span>
                                                </DropdownLink>
                                            </template>
                                        </Dropdown>
                                    </td>
                                </tr>
                                <!-- More people... -->
                                </tbody>
                            </table>
                            <div
                                v-else
                                class="text-center my-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-semibold text-gray-900">No users found</h3>
                                <p class="mt-1 text-sm text-gray-500">Click "back" to revert actions</p>
                                <div class="mt-6">
                                    <button
                                        @click="search"
                                        type="button"
                                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Back
                                    </button>
                                </div>
                            </div>

                        </div>
                        <Pagination
                            v-if="props.users.last_page > 1"
                            :links="props.users"
                            @page-changed="search"
                        />
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
