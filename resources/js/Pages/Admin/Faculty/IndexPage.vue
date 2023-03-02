<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Layouts/Breadcrumbs.vue";
import { Link } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination/Pagination.vue";
import Dropdown from "@/Components/Dropdown/Dropdown.vue";
import DropdownLink from "@/Components/Dropdown/DropdownLink.vue";
import BaseButton from "@/Components/Buttons/BaseButton.vue";
import EllipsisVertical from "@/Components/Icons/EllipsisVertical.vue";
import { ref } from "vue";
import {Inertia} from "@inertiajs/inertia";

let props = defineProps({
    faculties: {
        type: Object,
        required: false
    }
});
const searchTerm = ref('');

let search = (page = 1) => {
    Inertia.get(
        route('admin.team.index'),
        {
            search:searchTerm.value,
            page:page
        },
        {
            preserveState: true
        }
    )
}

</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumbs />
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <Link
                        type="button"
                        class="block rounded-md bg-indigo-600 py-1.5 px-3 text-center text-sm font-semibold
                            leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline
                            focus-visible:outline-2 focus-visible:outline-offset-2
                            focus-visible:outline-indigo-600"
                        :href="route('admin.team.create')"
                    >
                        Add user
                    </Link>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
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
                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">
                                        Phone
                                    </th>
                                    <th
                                        scope="col"
                                        class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                        Address
                                    </th>
                                    <th
                                        scope="col"
                                        class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="faculty in props.faculties.data"
                                    :key="faculty.id"
                                >
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ faculty.fullname }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ faculty.email }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ faculty.phone }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ faculty.address }}
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
                                                    href="#">
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
                        </div>
                        <Pagination
                            :links="props.faculties"
                            @page-changed="search"
                        />
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
